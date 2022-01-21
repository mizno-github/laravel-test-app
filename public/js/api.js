
$(function () {
  var method = 'GET';
  var dir = 'all';
  var data = {};
  var id = '';
  var title = '';
  var content = '';
  var todoJson;
  var editDom;

  function useapi() {
    data = {
      id: id,
      title: title,
      content: content,
    }
    $.ajax({
      type: method,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "/api/todo/" + dir,
      data: data,
      success: successFunc,
      error: errFunc
    });
  }

  function successFunc(data) {
    if (method == 'GET') {
      todoJson = data;
      var list = "";

      todoJson.forEach(function (todo, idx) {
        list += '<li>' +
          'idは' + todo.id +
          'titleは<span class="title">' + todo.title + '</span>' +
          'contentは<span class="content">' + todo.content + '</span>' +
          '<input class="delete" data-id="' + todo.id + '" type="button" value="削除">' +
          '<input class="edit" data-id="' + todo.id + '" type="button" value="編集">'
        '</li>';
      });
      $('#list').append(list);
    } else {
      alert(data + 'が完了しました。')
    }
  }

  function errFunc() {
    alert("エラーが発生しました。");
  }

  useapi();

  $('ul').on('click', '.delete', function () {
    var todoId = $(this).data('id');
    method = 'DELETE';
    dir = todoId;

    $(this).parent().remove();
    useapi();
  })

  $('ul').on('click', '.edit', function () {
    editDom = $(this);

    var todoId = $(this).data('id');
    var editTitle = $(this).parent().find('.title').text();
    var editContent = $(this).parent().find('.content').text();

    $('#inputId').val(todoId);
    $('#inputTitle').val(editTitle);
    $('#inputContent').val(editContent);
  })

  $('#updateOrCreate').on('click', function () {
    id = $('#inputId').val();
    title = $('#inputTitle').val();
    content = $('#inputContent').val();

    $('#inputId').val('');
    $('#inputTitle').val('');
    $('#inputContent').val('');

    // 編集と作成を判断する
    if (id != '') {
      update();
    } else {
      $('#inputId').val('');
      create();
    }
  })

  function update() {
    editDom.parent().find('.title').text(title)
    editDom.parent().find('.content').text(content)
    method = 'PUT';
    dir = id;

    useapi();
  }

  function create() {
    $('#list').append(
      '<li>' +
      'idは' + id +
      'titleは<span class="title">' + title + '</span>' +
      'contentは<span class="content">' + content + '</span>' +
      '<input class="delete" data-id="' + id + '" type="button" value="削除">' +
      '<input class="edit" data-id="' + id + '" type="button" value="編集">' +
      '</li>'
    );
    method = 'POST';
    dir = '';
    useapi();
  }
})
