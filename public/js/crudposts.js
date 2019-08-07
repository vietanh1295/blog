
function updateForm(data){
  $("#article_id").val(data.id);
  $("#title").val(data.title);
  $("#body").val(data.body);
  $("#submit").attr("onclick","edit()");
}
function removeForm(){
  $("#article_id").val('');
  $("#title").val('');
  $("#body").val('');
  $("#submit").attr("onclick","add()");
}
function deleteData(id){
  axios.delete(`/articles/${id}`, {
})
.then(function (data) {
  $(`#article${data.data.id}`).addClass('highlight-danger');
  setTimeout(
    function(){
      $(`#article${data.data.id}`).removeClass('highlight-danger');
      $(`#article${data.data.id}`).remove();

}, 800);

})
.catch(function (error) {
  console.log(error);
});
}
function add(){
  axios.post('/articles', {
    title: $('#title').val(),
    user_id: $('#user_id').val(),
    body: $('#body').val()
})
.then(function (data) {
  if(data.data.body.length>50){
      body = data.data.body.substr(0,50)+"...";
    }
    else{
      body = data.data.body;
    }
    if(data.data.title.length>25){
      title = data.data.title.substr(0,25)+"...";
    }
    else{
      title = data.data.title;
    }
    var jsondata = JSON.stringify(data.data);
    $(`tbody`).prepend(`
    <tr id="article${data.data.id}" class="highlight-success">
        <td><a href="/articles/${data.data.id}">${title}</a></td>
        <td>${body}</td>
        <td>${data.data.created_at}</td>
        <td>${data.data.updated_at}</td>
        <td><button class="btn" onclick='updateForm(${jsondata})' data-toggle="modal" data-target="#myModal"><span class="fas fa-edit"></span></button>
        <button class="btn" onclick="deleteData(${data.data.id})"><span class="fas fa-trash"></span></button></td>
    </tr>
      `)

    $('#close').click();
    setTimeout(function(){$('.highlight-success').removeClass('highlight-success')}, 2500);
})
.catch(function (error) {
  var errors = Object.keys(error.response.data.errors) ;
    var error_name = errors[0];
    $('#message').html(
      `<div class="alert alert-danger">
      ${error.response.data.errors[error_name]}
      </div>`)
      $('.alert').fadeOut(3000)
});
}
function edit(){
  id = $('#article_id').val();
  axios.put(`/articles/${id}`, {
    title: $('#title').val(),
    body: $('#body').val()
  })
  .then(function (data) {
    if(data.data.body.length>50){
      body = data.data.body.substr(0,50)+"...";
    }
    else{
      body = data.data.body;
    }
    if(data.data.title.length>25){
      title = data.data.title.substr(0,25)+"...";
    }
    else{
      title = data.data.title;
    }
    var jsondata = JSON.stringify(data.data);
    $(`#article${data.data.id}`).html(`
        <td><a href="/articles/${data.data.id}">${title}</a></td>
        <td>${body}</td>
        <td>${data.data.created_at}</td>
        <td>${data.data.updated_at}</td>
        <td><button class="btn" onclick='updateForm(${jsondata})' data-toggle="modal" data-target="#myModal"><span class="fas fa-edit"></span></button>
        <button class="btn" onclick="deleteData(${data.data.id})"><span class="fas fa-trash"></span></button></td>
      `)
    $(`#article${data.data.id}`).addClass('highlight-success');
    $('#close').click();
    setTimeout(function(){$('.highlight-success').removeClass('highlight-success')}, 2500);
  })
  .catch(function (error) {
    var errors = Object.keys(error.response.data.errors) ;
    var error_name = errors[0];
    $('#message').html(
      `<div class="alert alert-danger">
      ${error.response.data.errors[error_name]}
      </div>`)
      $('.alert').fadeOut(3000)
  });
}
