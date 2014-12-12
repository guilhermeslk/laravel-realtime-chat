var
    app         = require('http').createServer(handler),
    io 	        = require('socket.io')(app),
    redis       = require('redis'),
    fs          = require('fs'),
    redisClient = redis.createClient();

app.listen(3000);

console.log('Realtime Chat Server running at http://127.0.0.1:3000/');

function handler (req, res) {
	fs.readFile(__dirname + '/index.html', function(err, data) {
        if(err) {
            res.writeHead(500);
            return res.end('Error loading index.html');
        }
        res.writeHead(200);
        res.end(data);
    });
}

/***
    Redis Channels Subscribes
***/
redisClient.subscribe('chat.conversations');
redisClient.subscribe('chat.messages');

/***
    Redis Events
***/
redisClient.on('message', function(channel, message) {
    var result = JSON.parse(message);

    io.to('admin').emit(channel, 'channel -> ' + channel + ' |  room -> ' + result.room);
    io.to(result.room).emit(channel, result);
});

/***
    Socket.io Connection Event
***/
io.on('connection', function(socket) {
    socket.emit('welcome',  { message: 'Welcome! Realtime Chat Server running at http://127.0.0.1:3000/'} );

    /***
        Socket.io Events
    ***/

    socket.on('join', function(data) {
         socket.join(data.room);
         socket.emit('joined', { message: 'Joined room: ' + data.room });
    });
});
