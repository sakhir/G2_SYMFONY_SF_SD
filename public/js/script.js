
     $('#etudiant_chambre').hide();
     $('#cha').hide();
    //remove exiting input when change choice
    $('#etudiant_bourse').change(() => {
        $('#content-rep').remove();
    });

    $('#etudiant_loge').change(() => {
        $('#content-rep1').remove();
    });


    //generate input
      $('#etudiant_bourse').change(() => {

        const type_bourse = $('#etudiant_bourse').val();
   
            if (type_bourse === 'non') {

                const div = $(
                    "<div class='form-control' id='content-rep'><label>Adresse</label> <input name='addresse' id ='etudiant_addrese' type='text' required='required'></div>"
                );
                $('#etudiant_bourse').after(div);
                $('#etudiant_chambre').hide();
                $('#cha').hide();
            }



       // let number_reponse_input = $('.reponse');

        if (type_bourse === 'oui') {
        

            const div = $(
                "<div class='' id='content-rep'><label>Logement</label> " +
                "<select id='etudiant_loge' class='form-control' name='loge'> " +
                "<option value='oui'> Oui</option><option value='non'> Non</option> </select> </div>"
            );
            $('#etudiant_bourse').after(div);
        }

   const etudiant_loge = $('#etudiant_loge').val();
         
            if (etudiant_loge === 'non') {
                $('#etudiant_chambre').hide();
                $('#cha').hide();
                const div = $(
                    "<div class='form-control' id='content-rep1'><label>Adresse</label> <input name='addresse' id ='etudiant_addrese' type='text' required='required'></div>"
                );
                $('#etudiant_loge').after(div);
                
            }
         if (etudiant_loge === 'oui') {
            $('#etudiant_chambre').show();
             $('#cha').show(); 
        }




$('#etudiant_loge').change(() => { 
 const etudiant_loge = $('#etudiant_loge').val();

  $('#content-rep1').remove();
   
            if (etudiant_loge === 'non') {

                const div = $(
                    "<div class='form-control' id='content-rep1'><label>Adresse</label> <input name='addresse' id ='addrese' type='text' required='required'></div>"
                );
                $('#etudiant_loge').after(div);
                $('#etudiant_chambre').hide();
                $('#cha').hide();
            }
         if (etudiant_loge === 'oui') {
            console.log("oui");
            $('#etudiant_chambre').show();
            $('#cha').show();
        }

});
        
});

