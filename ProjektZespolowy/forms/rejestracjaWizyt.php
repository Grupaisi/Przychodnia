<script type="text/javascript">
               var specjalizacje = new Array("Dentysta", "Chirurg", "Onkolog", "Dermatolog" );
               var nazwiskoLekarza = new Array();
               nazwiskoLekarza["Dentysta"] = new Array("Tomasz Kowalski", "Agnieszka Nowak");
               nazwiskoLekarza["Chirurg"] = new Array("Natalia Rogacka", "Adam Konopnicki");
               nazwiskoLekarza["Onkolog"] = new Array("Kamil Rydel", "Radosław Piotrowicz");
               nazwiskoLekarza["Dermatolog"] = new Array("Anna Nowacka", "Michał Pryt");

               function resetForm(theForm) {
                    /* reset specjalizacje */
                    theForm.specjalizacje.options[0] = new Option("Proszę wybrać specjalizację", "");
                    for (var i=0; i<specjalizacje.length; i++) {
                         theForm.specjalizacje.options[i+1] = new Option(specjalizacje[i], specjalizacje[i]);
                    }
                    theForm.specjalizacje.options[0].selected = true;
                    /* reset nazwiskoLekarza */
                    theForm.nazwiskoLekarza.options[0] = new Option("Proszę wybrać lekarza", "");
                    theForm.nazwiskoLekarza.options[0].selected = true;
               }

               function updateModels(theForm) {
                    var make = theForm.specjalizacje.options[theForm.specjalizacje.options.selectedIndex].value;
                    var newModels = nazwiskoLekarza[make];
                    theForm.nazwiskoLekarza.options.length = 0;
                    theForm.nazwiskoLekarza.options[0] = new Option("Proszę wybrać lekarza", "");
                    for (var i=0; i<newModels.length; i++) {
                         theForm.nazwiskoLekarza.options[i+1] = new Option(newModels[i], newModels[i]);
                    }
                    theForm.nazwiskoLekarza.options[0].selected = true;
               }

          </script>
          <form name="autoSelectForm" action="" method="post">
               Data Wizyty: <br /><input type="date" name="dataWizyty" /><br />
               Wybierz Interesującą cię specjalizację:<br />
               <select size="1" name="specjalizacje" onchange="updateModels(this.form)">
               </select><br />
               Wybierz lekarza:<br />
               <select size="1" name="nazwiskoLekarza">
               </select><br/>
               <input type="submit" name="szukajDaty">
          </form>
          <script type="text/javascript">
               resetForm(document.autoSelectForm);
          </script>