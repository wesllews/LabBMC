  $(document).ready(function() 
  {
		$('#contact_form').bootstrapValidator
	(
		
		{
			// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
			feedbackIcons: {
			   valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: 
			{
				subunidade: 
				{
					validators: 
					{
					
							stringLength: 
							{
								min: 3,
							},
							notEmpty: 
							{
								message: 'Por favor, digite um campo válido!'
							}
					}
				},
				 
				titulo: 
				{
					validators:
					{
						notEmpty:
						{
							message: 'Por favor, digite um campo válido!'
						},
						emailAddress: 
						{
							message: 'Por favor, digite um campo válido!'
						}
					}
				},
			   conteudo: 
				{
					validators: 
					{
							stringLength: 
							{
								min: 6,
							},
							notEmpty:
							{
								message: 'Por favor, digite campo válido!'
							}
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





