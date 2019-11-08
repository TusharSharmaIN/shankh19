const Joi = require('@hapi/joi'); // for validation

// Function to validate data provided during registration
const registerValidation = (data) => {
    // Joi registration validation schema
    const schema = Joi.object({
        username: Joi.string().min(6).max(15).required(),
        password: Joi.string().min(6).max(15).required(),
        token: Joi.string().required()
    });
    return schema.validate(data);
}

// Function to validate login credentials
const loginValidation = (data) => {
    // Joi login validation schema
    const schema = Joi.object({
        username: Joi.string().min(6).max(15).required(),
        password: Joi.string().min(6).max(15).required(),
    });
    return schema.validate(data);
}

module.exports.registerValidation = registerValidation;
module.exports.loginValidation = loginValidation;