const router = require('express').Router();
const Admin = require('../model/Admin.js');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const {loginValidation} = require('../misc/validation.js');
const verifyJWT = require('../routes/verifyJWT.js');

/* Handle all login requests */

// GET request
router.get('/login', (req, res) => {
    if(req.session.uid){
        return res.redirect('/dashboard');
    }
    res.render('login.ejs');
});

// POST request to login
router.post('/login', async (req, res) => {
    // Validate data
    const { error } = loginValidation(req.body);
    if(error) return res.status(401).send({ login: false, message: "Invalid credentials." });
    
    // Check if username exist or not
    const admin = await Admin.findOne({ username: req.body.username });
    if(!admin) return res.status(401).send({ login: false, message: "Invalid credentials." });

    // Check if password matches or not
    const validPass = await bcrypt.compare(req.body.password, admin.password);
    if(!validPass) return res.status(401).send({ login: false, message: "Invalid credentials." });

    // Create and assign a JWT
    const token = jwt.sign({_id: admin._id}, process.env.JWT_TOKEN, {expiresIn: '15s'});
    // Set session
    req.session.uid = admin._id;
    req.session.jwt = token;
    // All okay
    res.status(200).send({ login: true, message: "Login successful. You will now be redirected to dashboard." });
});

module.exports = router;