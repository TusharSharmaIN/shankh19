const router = require('express').Router();
const Admin = require('../model/Admin');
// Validation
const Joi = require('@hapi/joi');

// Joi validation schema
const validationSchema = Joi.object({
    id: Joi.string().min(6).required(),
    password: Joi.string().min(6).required()
});

router.get('/login', (req, res) => {
    res.render('login.ejs');
});

router.post('/login', async (req, res) => {
    const { error } = validationSchema.validate(req.body);
    if(error) return res.status(400).send(error.details[0].message);
    res.status(200).send('All good');
    // const admin = new Admin({
    //     id: req.body.id,
    //     password: req.body.password
    // });
    // try{
    //     const savedAdmin = await admin.save();
    //     res.send(savedAdmin);
    // } catch(err){
    //     res.status(400).send(err);
    // }
});

router.post('/register', async (req, res) => {
    const { error } = validationSchema.validate(req.body);
    if(error) return res.status(400).send(error.details[0].message);

    const admin = new Admin({
        _id: req.body.id,
        password: req.body.password
    });
    try{
        const savedAdmin = await admin.save();
        res.send(savedAdmin);
    } catch(err){
        res.status(400).send(err);
    }
});

module.exports = router;