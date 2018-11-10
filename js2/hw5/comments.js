function Comments() {
    this.count = 0;
    this.comments = [];
}

/**
 * Отрисовка формы для добавления отзывов
 * @returns {*|jQuery|HTMLElement}
 */


Comments.prototype.renderForm = function () {
    let self = this;
    let form = $('<form />', {
        id: 'form_comment'
    });
    let fieldset = $('<fieldset />');
    fieldset.append($('<legend />', {text: 'Добавьте свой отзыв'}));
    fieldset.append($('<p />', {text: 'Имя'}));
    fieldset.append($('<input />', {type: 'text', id: 'name'}));
    fieldset.append($('<p />', {text: 'Сообщение'}));
    fieldset.append($('<textarea />', {id: 'message', cols: 30, rows: 5}));
    let button = $('<input />', {
        id: 'submit',
        type: 'button',
        value: 'Ооправить'
    });
    button.on('click', function () {
        self.add(this);
    });
    fieldset.append(button);
    form.append(fieldset);
    return form;
};

/**
 * Отрисовка блока отзывов
 * @param root
 */

Comments.prototype.render = function (root) {
    this.getComments();
    let container = '#' + root;
    let form = this.renderForm();
    $(container).append(form);
    let comments_block = $('<div />', {
        id: 'comments_block',
        html: '<h3>Отзывы</h3>'
    });
    $(container).append(comments_block);
};

/**
 * Получение отзывов с сервера (json-файла)
 */

Comments.prototype.getComments = function () {
    $.get({
        url: './comments.json',
        dataType: 'json',
        context: this,
        success: function (data) {
            this.comments = data.comments;
            this.count = data.count;
            this.refresh();
        },
        error: function (error) {
            console.log('Ошибка:', error.status, error.statusText);
        }
    })
};

/**
 * Обновление отзывов
 */

Comments.prototype.refresh = function () {
    let comments_block = $('#comments_block');
    comments_block.empty();
    let self = this;
    for (let i = 0; i < this.comments.length; i++) {
        let comment_item = $('<div />', {
            id: 'comment_' + i,
            class: 'comment_item'
        });
        comment_item.append(this.renderDeletePict(i),
                            this.renderUserName(i),
                            this.renderTextComment(i),
                            this.renderLikes(i));
        $(comments_block).append(comment_item);

        $('#like_' + i).on('click', function () {
            self.addLike(this);
        });

        $('#delete_' + i).on('click', function () {
            self.delete(this);
        })
    }
};

/**
 * Рендеринг пиктограммы удаления отзыва
 * @param i
 * @returns {*|jQuery|HTMLElement}
 */

Comments.prototype.renderDeletePict = function (i) {
    let p = $('<p />');
    let img = $('<img />', {
        class: 'delete',
        id: 'delete_' + i,
        src: 'img/close.png',
        width: 15,
        height: 15
    });
    p.append(img);
    return p;
};

/**
* Рендеринг отображения имени пользователя
* @param i
* @returns {*|jQuery|HTMLElement}
*/

Comments.prototype.renderUserName = function (i) {
    let p = $('<p />', {
        class: 'user_name',
        text: this.comments[i].name
    });
    return p;
};

/**
 * Рендеринг отображения текста отзыва
 * @param i
 * @returns {*|jQuery|HTMLElement}
 */

Comments.prototype.renderTextComment = function (i) {
    let p = $('<p />', {
        class: 'text_comment',
        text: this.comments[i].text
    });
    return p;
};

/**
 * Рендеринг отображения одобрений
 * @param i
 * @returns {*|jQuery|HTMLElement}
 */

Comments.prototype.renderLikes = function (i) {
    let p = $('<p />', {
        class: 'likes',
        id: 'like_' + i
    });
    let img = $('<img />', {
        src: 'img/like.png',
        width: 25,
        height: 25
    });
    let span = $('<span />');
    if (this.comments[i].likes != 0) {
        span.text(this.comments[i].likes);
    }
    p.append(img, span);
    return p;
};

/**
 * Удаление отзыва
 * @param elem
 */

Comments.prototype.delete = function (elem) {
    let id_deleted = elem.id.split('_')[1];
    this.comments.splice(id_deleted, 1);
    this.refresh();
};

/**
 * Добавление одобрения отзыва
 * @param elem
 */

Comments.prototype.addLike = function (elem) {
    let id_comment = elem.id.split('_')[1];
    this.comments[id_comment].likes++;
    this.refresh();
};

/**
 * Добавление отзыва
 * @param elem
 */

Comments.prototype.add = function (elem) {
    let name = $('#name')[0].value;
    let message = $('#message')[0].value;
    let id_new_comment = this.comments.length + 1;
    let newComment = {
        'id_comment': id_new_comment,
        'name': name,
        'text': message,
        'likes': 0
    };
    this.comments.push(newComment);
    this.refresh();
};
