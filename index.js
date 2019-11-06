const express = require('express');
const app = express();
const dotenv = require('dotenv');
const mongoose = require('mongoose');
const authRoute = require('./routes/auth');

dotenv.config();
app.set('view-engine', 'ejs');
// To include css files in html
app.use(express.static(__dirname + '/'));

// Connect to MongoDB
mongoose.connect(
    process.env.MONGODB_CONNECT, 
    { useNewUrlParser: true, useUnifiedTopology: true },
    () => console.log('Connected to MongoDB')
);

// Middleware
app.use(express.json());

// Route middleware
app.use('/', authRoute);

app.listen(3000, () => console.log('Server is up'));