const router = require('express').Router();
const Admin = require('../model/Admin.js');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const {loginValidation} = require('../misc/validation.js');
const verifyAuth = require('../routes/verifyJWT.js');

/* Handle all login requests */

// GET request
router.get('/login', (req, res) => {
    res.render('login.ejs');
});

router.get('/get/events', verifyAuth, (req, res) => {
    res.send(req.admin);
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
    const token = jwt.sign({_id: admin._id}, process.env.JWT_TOKEN);
    // res.header('auth-token', token);

    // All okay
    res.status(200).header('auth-token', token).send({ login: true, message: "Login successful. You will now be redirected to dashboard.", token: token});
});

module.exports = router;