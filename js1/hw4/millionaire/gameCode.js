var event, ok, i=0;

do {
    ok = false;
    event = +prompt(works.a00 + works.a1 + works.a2 + works.a3 + works.a4 + '-1 - Выход из игры\n');
    if (event == -1) {
        break;
    }
    else if (event == 2) {
        alert('Это правильный ответ!');
        i++;
    }
    else {
        alert('Вы ошиблись')
    }

} while (!event);

do {
    ok = false;
    event = +prompt(works.b00 + works.b1 + works.b2 + works.b3 + works.b4 + '-1 - Выход из игры\n');
    if (event == -1) {
        break;
    }
    else if (event == 3) {
        alert('Это правильный ответ!');
        i++;
    }
    else {
        alert('Вы ошиблись')
    }

} while (!event);

do {
    ok = false;
    event = +prompt(works.c00 + works.c1 + works.c2 + works.c3 + works.c4 + '-1 - Выход из игры\n');
    if (event == -1) {
        break;
    }
    else if (event == 1) {
        alert('Это правильный ответ!');
        i++;
    }
else {
        alert('Вы ошиблись')
    }
}
while (!event);

do {
    ok = false;
    event = +prompt(works.d00 + works.d1 + works.d2 + works.d3 + works.d4 + '-1 - Выход из игры\n');
    if (event == -1) {
        break;
    }
    else if (event == 2) {
        alert('Это правильный ответ!');
        i++;
    }
else {
        alert('Вы ошиблись')
    }
}
while (!event);

do {
    ok = false;
    event = +prompt(works.e00 + works.e1 + works.e2 + works.e3 + works.e4 + '-1 - Выход из игры\n');
    if (event == -1) {
        break;
    }
    else if (event == 3) {
        alert('Это правильный ответ!');
        i++;
    }
else {
        alert('Вы ошиблись')
    }
}
while (!event);
alert('Спасибо за игру' + 'У вас' + ' ' + ' ' + i + ' ' + 'правильных ответов');

function isAnswer(event) {
    if (isNaN(event) || !isFinite(event)) {
        alert('Вы ввели недопустимый символ');
        return false;
    }
    else if (event < 1 || event > 4) {
        alert('Ваше число выходит из допустимого диапозона');
        return false;
    }
    else {
        return true;
    }
}