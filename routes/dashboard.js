const router = require('express').Router();

/* Handle GET request to dashboard */

router.get('/dashboard', (req, res) => {
    if(req.session.uid == null){
        return res.redirect('/login');
    }
    res.render('dashboard.ejs');
});

module.exports = router;