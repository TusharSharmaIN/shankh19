const router = require('express').Router();

/* Handle GET request to dashboard */

router.get('/dashboard', (req, res) => {
    res.render('dashboard.ejs');
});

module.exports = router;