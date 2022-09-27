window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) { }


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import './custom.js';
import './scripts.js';
import './stisla.js';