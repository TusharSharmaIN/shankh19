const jwt = require('jsonwebtoken');

// Function to verify JWT
const auth = (req, res, next) => {
    const token = req.header('auth-token');
    if(!token) return res.status(400).send({ hasAccess: false, message: 'Access denied'});

    try{
        const admin = jwt.verify(token, process.env.JWT_TOKEN);
        req.admin = admin;
        next();
    } catch(err){
        res.status(403).send({ hasAccess: false, message: 'Invalid token'});
    }
}

module.exports = auth;