const router = require('express').Router();
const Admin = require('../model/Admin.js');
const bcrypt = require('bcrypt');
const {loginValidation} = require('../validation.js');

/* Handle all login requests */

// GET request
router.get('/login', (req, res) => {
    res.render('login.ejs');
});

// POST request to login
router.post('/login', async (req, res) => {
    // Validate data
    const { error } = loginValidation(req.body);
    if(error) return res.status(400).send({ login: false, message: error.details[0].message });
    
    // Check if username exist or not
    const admin = await Admin.findOne({ username: req.body.username });
    if(!admin) return res.status(400).send({ login: false, message: "Invalid credentials. Check your username." });

    // Check if password matches or not
    const validPass = await bcrypt.compare(req.body.password, admin.password);
    if(!validPass) return res.status(400).send({ login: false, message: "Invalid credentials. Check your password." });

    // All okay
    res.status(200).send({ login: true, message: "Login successful. You will now be redirected to dashboard." });
});

module.exports = router;