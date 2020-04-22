$(document).ready(function() 
  {
		$('#formtudo').bootstrapValidator
	(
		
		{
			// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
			feedbackIcons: {
			   /* valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'*/
			},
			fields: 
			{
				
			   senhaatual: 
				{
					validators: 
					{
							stringLength: 
							{
								min: 6,
							},
							notEmpty:
							{
								
							}
					}
				},
				 
				
			   loginsenha: 
				{
					validators: 
					{
							stringLength: 
							{
								min: 6,
							},
							notEmpty:
							{
								
							}
					}
				},
				confsenha: 
				{
					validators: 
					{
							stringLength:
							{
								min: 6,
							},

							//identical: 
							//{
							//field: 'senha',
							//},
							
							notEmpty:
							{

							
							}							
					}
					
				},
				
				//separei em 2 fonfsenha porque senão ficava 2 mensagerns de erro;
				
				confsenha: 
				{
					validators: 
					{
							identical: 
							{
							field: 'loginsenha',
							},
							
										
					}
					
				},


				
			}//fields
			})
			.on('success.form.bv', function(e) 
			{
				
				$('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
					$('#contact_form').data('bootstrapValidator').resetForm();

				// Prevent form submission
				e.preventDefault();

				// Get the form instance
				var $form = $(e.target);

				// Get the BootstrapValidator instance
				var bv = $form.data('bootstrapValidator');

				// Use Ajax to submit form data
				$.post($form.attr('action'), $form.serialize(), function(result) {
					console.log(result);
				}, 'json');
			});//function
			
			

}//fecha do document
);

function letras(){
	tecla = event.keyCode;
	if (tecla >= 33 && tecla <= 64 || tecla >= 91 && tecla <= 93 || tecla >= 123 && tecla <= 159 || tecla >= 162 && tecla <= 191 ){ 
	    return false;
	}else{
	   return true;
	}
}

