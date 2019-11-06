const mongoose = require('mongoose');

const adminSchema = new mongoose.Schema({
    _id: {
        type: String,
        required: true,
        min: 6,
        max: 15
    },
    password: {
        type: String,
        required: true,
        min: 6,
        max: 255
    },
    lastLogin: {
        type: Date,
        default: Date.now
    }
});

module.exports = mongoose.model('Admin', adminSchema);