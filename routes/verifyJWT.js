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
        if(err.name === 'TokenExpiredError'){

        }
        else 
            res.status(403).send({ hasAccess: false, message: 'Invalid token', error: err});
    }
}

module.exports = auth;