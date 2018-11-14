$(document).ready(function(){				
                $('#proiectare_il_dtac_select_proprietar').change(function(e){
                    
					var data = {};
					var tipdoc = document.getElementById("proiectare_il_tip_formular");
					var tip = tipdoc.value;
					var selectproprietardtacil = document.getElementById("proiectare_il_dtac_select_proprietar");
					var proprietar = document.getElementById("proiectare_il_dtac_proprietar");
					var judet = document.getElementById("proiectare_il_dtac_judet");
					var localitate = document.getElementById("proiectare_il_dtac_localitate");
					var numar = document.getElementById("proiectare_il_dtac_numar");
					var mydata = document.getElementById("proiectare_il_dtac_data");
					var adresa = document.getElementById("proiectare_il_dtac_adresa");
					var scop = document.getElementById("proiectare_il_dtac_scop");
					var suprafata_teren = document.getElementById("proiectare_il_dtac_teren");
					var pot = document.getElementById("proiectare_il_dtac_pot");
					var cut = document.getElementById("proiectare_il_dtac_cut");
					var regim_inaltime = document.getElementById("proiectare_il_dtac_regim_inaltime");
					var suprafata_constructie = document.getElementById("proiectare_il_dtac_suprafata_constructie");
					data.proprietar = selectproprietardtacil.value;
					data.judet = "judet";
					data.numar = "numar";
					data.tip = "dtac"
					$.ajax({
						type: 'POST',
						data: JSON.stringify(data),
				        contentType: 'application/json',
                        url: 'http://localhost:8080/proiectareildtac',						
                        success: function(data) {
                            console.log('success');
                            console.log(JSON.stringify(data));
							console.log(data[0].proprietar)
							console.log(data[0]);
							jsondata = JSON.parse(data);
							console.log("proprietarul este : " + jsondata[0].proprietar);
							proprietar.value = jsondata[0].proprietar;
							judet.value = jsondata[0].judet;
							localitate.value = jsondata[0].localitate;
							numar.value = jsondata[0].numar;
							mydata.value = jsondata[0].data;
							adresa.value = jsondata[0].adresa;
							scop.value = jsondata[0].scop;
							suprafata_teren.value = jsondata[0].suprafata_teren;
							pot.value = jsondata[0].pot;
							//$("#id_tipdtacil").val(data.tip);
							cut.value = jsondata[0].cut;
							regim_inaltime.value = jsondata[0].regim_inaltime;
							suprafata_constructie.value = jsondata[0].suprafata_constructie;
                        }
                    });
                });				
            });