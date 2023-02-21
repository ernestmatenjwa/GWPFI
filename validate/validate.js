const validator = new JustValidate('#form1');

validator
  .addField('#names', [
    {
      rule: 'required',
    },
    {
      rule: 'minLength',
      value: 3,
    },
    {
      rule: 'maxLength',
      value: 15,
    },
  ])
  .addField('#surname', [
    {
      rule: 'required',
    },
    {
      rule: 'minLength',
      value: 3,
    },
    {
      rule: 'maxLength',
      value: 25,
    },
  ])
  .addField('#phone', [
    {
      rule: 'required',
    },
    {
      rule: 'number',
    },
    {
      rule: 'minLength',
      value: 10,
    },
    {
      rule: 'maxLength',
      value: 10,
    },
  ])
  .addField('#email', [
    {
      rule: 'required',
    },
    {
      rule: 'email',
    },
    {
      validator: (value) => () => {
        return fetch("validate-email.php?email=" + encodeURIComponent(value))
        .then(function(response){
          return response.json();
        })
        .then(function(json){
          return json.available;
        });
      },
      errorMessage: "Email already taken"
    }
  ])
  .addField('#key', [
    {
      rule: 'required',
    },
    {
      rule: 'minLength',
      value: 8,
    },
    {
      rule: 'maxLength',
      value: 20,
    },
  ])
  .addField('#position', [
    {
      rule: 'required',
    },
  ])
  .addField('#gender', [
    {
      rule: 'required',
    },
  ])
  .addField('#password', [
    {
      rule: 'required',
    },
    {
      rule: 'password',
    },
  ])
  .addField('#password2', [
    {
      validator: (value, fields) => {
        return value === fields["#password"].elem.value;
      },
      errorMessage: "Passwords should match"
    },
  ])
  .onSuccess((event) => {
    document.getElementById("form1").submit();
  });
