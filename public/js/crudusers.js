function updateForm(data){
  $("#user_id").val(data.id);
  $("#name").val(data.name);
  $("#email").val(data.email);
  $("#role").val(data.role_id);
  $("#password").val('');
  $("#submit").attr("onclick",`edit('${data.email}')`);
}
function removeForm(){
  $("#user_id").val('');
  $("#name").val('');
  $("#email").val('');
  $("#password").val('');
  $("#submit").attr("onclick","add()");
}
function deleteData(id){
  axios.delete(`/users/${id}`, {
})
.then(function (data) {
  $(`#user${data.data.id}`).addClass('highlight-danger');
  setTimeout(
    function(){
      $(`#user${data.data.id}`).removeClass('highlight-danger');
      $(`#user${data.data.id}`).remove();

}, 800);

})
.catch(function (error) {
  console.log(error);
});
}
function add(){
  axios.post('/users', {
    name: $('#name').val(),
    email: $('#email').val(),
    password: $('#password').val(),
    role_id: $('#role').val()
})
.then(function (data) {
    var jsondata = JSON.stringify(data.data);
    role = data.data.role_id == 1 ? "admin" : "user";
    $(`tbody`).prepend(`
    <tr id="user${data.data.id}" class="highlight-success">
        <td><a href="/users/${data.data.id}">${data.data.name}</a></td>
        <td>${data.data.email}</td>
        <td>${role}</td>
        <td>${data.data.created_at}</td>
        <td>${data.data.updated_at}</td>
        <td><button class="btn" onclick='updateForm(${jsondata})' data-toggle="modal" data-target="#myModal"><span class="fas fa-edit"></span></button>
        <button class="btn" onclick="deleteData(${data.data.id})"><span class="fas fa-trash"></span></button>
        </td>
    </tr>
      `);

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
function edit(email){
  id = $("#user_id").val();
  if($('#email').val()==email)
  {
    newemail = '';
  }
  else{
    newemail = $('#email').val();
  }
  axios.put(`/users/${id}`, {
    name: $('#name').val(),
    email: newemail,
    password: $('#password').val(),
    role_id: $('#role').val()
})
.then(function (data) {
    var jsondata = JSON.stringify(data.data);
    role = data.data.role_id == 1 ? "admin" : "user";
    $(`#user${data.data.id}`).html(`
        <td><a href="/users/${data.data.id}">${data.data.name}</a></td>
        <td>${data.data.email}</td>
        <td>${role}</td>
        <td>${data.data.created_at}</td>
        <td>${data.data.updated_at}</td>
        <td><button class="btn" onclick='updateForm(${jsondata})' data-toggle="modal" data-target="#myModal"><span class="fas fa-edit"></span></button>
        <button class="btn" onclick="deleteData(${data.data.id})"><span class="fas fa-trash"></span></button>
        </td>
      `);
    $(`#user${data.data.id}`).addClass('highlight-success');
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
