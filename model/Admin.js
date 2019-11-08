const mongoose = require('mongoose');

const adminSchema = new mongoose.Schema({
    username: {
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
    lastAccess: {
        type: Date,
        default: Date.now
    }
}, { collection: 'credentials' });

module.exports = mongoose.model('Admin', adminSchema);