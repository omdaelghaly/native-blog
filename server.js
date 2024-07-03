const express = require('express');
const http = require('http');
const socketIo = require('socket.io');

const app = express();
const server = http.createServer(app);
// const io = socketIo(server);

const PORT = process.env.PORT || 4000;


const io =require('socket.io')(server,{
  cors:{ 
     origin: '*', // I copied the origin in the error message and pasted here
     methods: ["GET", "POST"],
     credentials: true
   }
})

// Middleware to set socket properties
io.use((socket, next) => {
    socket.id = socket.handshake.query.id;
    socket.name = socket.handshake.query.name;
    next();
});

// Event handling when a client connects
io.on('connection', (socket) => {

if(socket.id){// user login 
        
    console.log('User connected:', socket.id);
    // Handle sending a message
    socket.on('new_post', (data) => {
        io.emit('new_post_s',data);
    });   
    socket.on('new_comment', (postId) => {
         io.emit('new_comment_s',postId);
         //console.log('new_comment id='+postId);
    });
    //messenger
    //seen
    socket.on('msg_seen', (my_id,u_id) => {
         io.emit('msg_seen_s',my_id,u_id);
    });
    //new msg
    socket.on('new_msg', (my_id,u_id) => {
         io.emit('new_msg_s',my_id,u_id);
    });

    socket.on('msg', (msg, user) => {
        io.emit('nmsg', { msg, user });
    });
    // Handle new stream start
    socket.on('newstream', () => {
        socket.broadcast.emit('newstreamstart');
    });

    // Handle writing event
    socket.on('iamwriting', () => {
        socket.broadcast.emit('iamwritings');
    });

    // Handle disconnection
    socket.on('disconnect', () => {
        console.log('User disconnected:', socket.id);
    });


}else{
    //user not login
}


});





// Start the server
server.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
