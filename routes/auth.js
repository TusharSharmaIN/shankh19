const router = require('express').Router();
const Admin = require('../model/Admin.js');
const bcrypt = require('bcrypt');
const {registerValidation, loginValidation} = require('../validation.js');

/* Handle GET request to index */

router.get('/', (req, res) => {
    res.redirect('login');
});

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

/* Handle all registration requests */

router.get('/register', (req, res) =>{
    res.render('register.ejs');
});

// POST request to register
router.post('/register', async (req, res) => {
    // Validate data
    const { error } = registerValidation(req.body);
    if(error) return res.status(400).send({ registered: false, message: error.details[0].message });
    
    // Verify secret token
    if(process.env.SECRET_TOKEN !== req.body.token)
        return res.status(400).send({ registered: false, message: "Invalid token." });

    // Check if username already exist
    const alreadyExist = await Admin.findOne({ username: req.body.username });
    if(alreadyExist) return res.status(400).send({ registered: false, message: "Username already exist." });

    // Hash password
    const salt = await bcrypt.genSalt(10);
    const hash = await bcrypt.hash(req.body.password, salt);

    // Create a new admin based on Admin schema
    const admin = new Admin({
        username: req.body.username,
        password: hash
    });

    // Save new admin
    try{
        const savedAdmin = await admin.save();
        res.send({registered: true, message: "Registration successful. Click <a href=\"/login\">here</a> to login."});
    } catch(err){
        res.status(400).send({ registered: false, message: "Oops! Something went wrong. Try again later." });
    }
});

/* Handle GET request to dashboard */

router.get('/dashboard', (req, res) => {
    res.render('dashboard.ejs');
});

module.exports = router;