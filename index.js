const express = require('express');
const app = express();
const dotenv = require('dotenv').config();
const mongoose = require('mongoose');
const cookieParser = require('cookie-parser');
const session = require('express-session');
const MongoStore = require('connect-mongo')(session);
const loginRoute = require('./routes/login.js');
const registerRoute = require('./routes/register.js');
const dashboardRoute = require('./routes/dashboard.js');

// Connect to MongoDB
mongoose.connect(
    process.env.MONGODB_CONNECT, 
    { useNewUrlParser: true, useUnifiedTopology: true },
    () => console.log('Connected to MongoDB')
);

/* Middleware */
app.set('view-engine', 'ejs');
app.use(express.static(__dirname + '/'));
app.use(express.json());
app.use(cookieParser());
app.use(session({
    secret: process.env.SESSION_SECRET_KEY,
    name: 'sid',
    resave: false,
    saveUninitialized: false,
    cookie: { sameSite: true },
    store: new MongoStore({ mongooseConnection: mongoose.connection, ttl: 60 })
}));

/* Routes */
// Login Route middleware
app.use('/', loginRoute);
// Register Route middleware
app.use('/', registerRoute);
// Dashboard Router middleware
app.use('/', dashboardRoute);
// Redirect all https://admin.shankhnaad.org requests to login page
app.get('/', (req, res) => {
    res.redirect('/login');
});
// NOTE: This should be placed at the end of all routes
// Redirect all 404 requests to login page
app.get('*', (req, res) => {
    res.render('404.ejs');
    res.status(404).send();
});

// Make express listen on port number 3000
app.listen(3000, () => console.log('Server is up'));