let data = require('./data');
let developer = require('./module');
let title = require('./app');

developer(data.surname, data.name, data.patronymic);

exports.developer = developer;
exports.title = title;