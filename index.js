const express = require('express');
const app = express();
const dotenv = require('dotenv');
const mongoose = require('mongoose');
const loginRoute = require('./routes/login.js');
const registerRoute = require('./routes/register.js');
const dashboardRoute = require('./routes/dashboard.js');

// To be able to use keys
dotenv.config();
// Set view engine to render html pages
app.set('view-engine', 'ejs');
// To include css files in html
app.use(express.static(__dirname + '/'));

// Connect to MongoDB
mongoose.connect(
    process.env.MONGODB_CONNECT, 
    { useNewUrlParser: true, useUnifiedTopology: true },
    () => console.log('Connected to MongoDB')
);

/* Middleware */
app.use(express.json());
// Login Route middleware
app.use('/', loginRoute);
// Register Route middleware
app.use('/', registerRoute);
// Dashboard Router middleware
app.use('/', dashboardRoute);

// NOTE: This should be placed at the end of all routes
// Redirect all 404 requests to login page
app.get('*', (req, res) => {
    res.redirect('/login');
});

// Make express listen on port number 3000
app.listen(3000, () => console.log('Server is up'));