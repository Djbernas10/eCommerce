<?php 

include "connection.php";

if (session_status() == PHP_SESSION_ACTIVE){ // se existir sessao corre o codigo
    if (!isset($_SESSION["logado"])){ // se não estiver logado vai para o login
        header("location: login.php");
    }
    
}
$idLogin = $_SESSION["idLogin"];
$qMoradas = mysqli_query($ligacao1,"SELECT * FROM morada WHERE User_idlogin LIKE '$idLogin' ");


if (isset($_GET["erro"])) { //erros relacionados
    switch($_GET["erro"]){
        case 1:
            echo"<script>alert('Não tem Moradas');</script>";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moradas</title>
    <link rel="stylesheet" href="assets/bootstrap_forms/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<nav class="navbar navbar-light navbar-expand-lg navigation-clean-button">
    <div class="container"><a class="navbar-brand" href="index.php">Book WareHouse</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="#">Acerca</a></li>
                <?php
                    if($_SESSION["permissao"]==1){
                     echo "<li class='nav-item'><a class='nav-link' href='admin_panel.php'>Admin</a></li>";
                    }
                    ?>
            </ul><span class="navbar-text actions"> <a class="login" href="<?php if(isset($_GET["addMoradas"]) || isset($_GET["verMoradas"])){echo"moradas.php";}else{echo"user_panel.php";}?>">Voltar</a><a class="btn btn-light action-button" role="button" href="logout.php">Logout</a></span>
        </div>
    </div>
</nav>
<?php



if(isset($_GET["verMoradas"])){
    $flag = false;
    $incremento =1;
    while($row=mysqli_fetch_assoc($qMoradas)){
        $nC = $row["nomeCompleto"];
        $l1 = $row["Linha1"];
        $cidade = $row["Cidade"];
        $cP = $row["CP"];
        $pais = $row["Pais"];
        echo "
        <main class='page contact-us-page'>
            <section class='clean-block clean-form dark'>
                <div class='container' style='color: var(--bs-blue);'>
                    <div class='block-heading'>
                        <h2 style='color: rgb(86,198,198);'>Morada ".$incremento."</h2>
                    </div>
                    <form style='border-top-color: rgb(86,198,198);color: rgb(0,0,0);' action='edicao.php?change=1' method='POST'>
                        <div class='mb-3'><p class='form-label'>Nome Completo:</p><p>$nC</p></div>
                        <div class='mb-3'><p class='form-label'>Linha de Morada:</p><p>$l1</p></div>
                        <div class='mb-3'><p class='form-label'>Cidade:</p><p>$cidade</p></div>
                        <div class='mb-3'><p class='form-label'>Código-Postal:</p><p>$cP</p></div>
                        <div class='mb-3'><p class='form-label'>Pais:</p><p>$pais</p></div>
                    </form>
                </div>
            </section>
        </main>";
        $flag = true;    // se completar o ciclo poe a variavel a true
        $incremento +=1;
    }
    if($flag === false){
        header("location: moradas.php?erro=1"); //entra caso a flag esteja a false
        //echo "<h1><a href='moradas.php'>Voltar</a> </h1>";
        }
        
    }
elseif(isset($_GET["addMoradas"])){
    ?>
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col">
            <div class="card my-4 shadow-3">
              <div class="row g-0">
                <div class="col-xl-6 d-xl-block bg-image">
                  <img src="https://mdbcdn.b-cdn.net/img/Others/extended-example/delivery.webp"
                    alt="Sample photo" class="img-fluid" />
                </div>
                <form class="col-xl-6" action='acao_morada.php?acao=1' method='post'>
                  <div class="card-body p-md-5 text-black">
                    <h3 class="mb-4 text-uppercase">Morada de Entrega</h3>
                      <div class="form-outline mb-4">
                        <div class="form-outline">
                          <input type="text" id='nC' name='nC' class="form-control form-control-lg" required />
                          <label class="form-label" for="nC">Nome Completo</label>
                        </div>
                      </div>
      
                    <div class="form-outline mb-4">
                      <input type="text" id='linha1' name='linha1' class="form-control form-control-lg" required/>
                      <label class="form-label" for="linha1">Linha de morada</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" id='cidade' name='cidade' class="form-control form-control-lg" required />
                      <label class="form-label" for="cidade">Cidade</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type='text' id='cP' name='cP' class="form-control form-control-lg" required />
                      <label class="form-label" for="cP">Codigo Postal</label>
                    </div>

                    <div class="col-md-6 mb-4">
                    <select id='pais' name='pais'>
                            <option value='Afghanistan'>Afghanistan</option>
                            <option value='Aland Islands'>Aland Islands</option>
                            <option value='Albania'>Albania</option>
                            <option value='Algeria'>Algeria</option>
                            <option value='American Samoa'>American Samoa</option>
                            <option value='Andorra'>Andorra</option>
                            <option value='Angola'>Angola</option>
                            <option value='Anguilla'>Anguilla</option>
                            <option value='Antarctica'>Antarctica</option>
                            <option value='Antigua and Barbuda'>Antigua and Barbuda</option>
                            <option value='Argentina'>Argentina</option>
                            <option value='Armenia'>Armenia</option>
                            <option value='Aruba'>Aruba</option>
                            <option value='Australia'>Australia</option>
                            <option value='Austria'>Austria</option>
                            <option value='Azerbaijan'>Azerbaijan</option>
                            <option value='Bahamas'>Bahamas</option>
                            <option value='Bahrain'>Bahrain</option>
                            <option value='Bangladesh'>Bangladesh</option>
                            <option value='Barbados'>Barbados</option>
                            <option value='Belarus'>Belarus</option>
                            <option value='Belgium'>Belgium</option>
                            <option value='Belize'>Belize</option>
                            <option value='Benin'>Benin</option>
                            <option value='Bermuda'>Bermuda</option>
                            <option value='Bhutan'>Bhutan</option>
                            <option value='Bolivia'>Bolivia</option>
                            <option value='Bonaire, Sint Eustatius and Saba'>Bonaire, Sint Eustatius and Saba</option>
                            <option value='Bosnia and Herzegovina'>Bosnia and Herzegovina</option>
                            <option value='Botswana'>Botswana</option>
                            <option value='Bouvet Island'>Bouvet Island</option>
                            <option value='Brazil'>Brazil</option>
                            <option value='British Indian Ocean Territory'>British Indian Ocean Territory</option>
                            <option value='Brunei Darussalam'>Brunei Darussalam</option>
                            <option value='Bulgaria'>Bulgaria</option>
                            <option value='Burkina Faso'>Burkina Faso</option>
                            <option value='Burundi'>Burundi</option>
                            <option value='Cambodia'>Cambodia</option>
                            <option value='Cameroon'>Cameroon</option>
                            <option value='Canada'>Canada</option>
                            <option value='Cape Verde'>Cape Verde</option>
                            <option value='Cayman Islands'>Cayman Islands</option>
                            <option value='Central African Republic'>Central African Republic</option>
                            <option value='Chad'>Chad</option>
                            <option value='Chile'>Chile</option>
                            <option value='China'>China</option>
                            <option value='Christmas Island'>Christmas Island</option>
                            <option value='Cocos (Keeling) Islands'>Cocos (Keeling) Islands</option>
                            <option value='Colombia'>Colombia</option>
                            <option value='Comoros'>Comoros</option>
                            <option value='Congo'>Congo</option>
                            <option value='Congo, Democratic Republic of the Congo'>Congo, Democratic Republic of the Congo</option>
                            <option value='Cook Islands'>Cook Islands</option>
                            <option value='Costa Rica'>Costa Rica</option>
                            <option value='Cote D'Ivoire'>Cote D'Ivoire</option>
                            <option value='Croatia'>Croatia</option>
                            <option value='Cuba'>Cuba</option>
                            <option value='Curacao'>Curacao</option>
                            <option value='Cyprus'>Cyprus</option>
                            <option value='Czech Republic'>Czech Republic</option>
                            <option value='Denmark'>Denmark</option>
                            <option value='Djibouti'>Djibouti</option>
                            <option value='Dominica'>Dominica</option>
                            <option value='Dominican Republic'>Dominican Republic</option>
                            <option value='Ecuador'>Ecuador</option>
                            <option value='Egypt'>Egypt</option>
                            <option value='El Salvador'>El Salvador</option>
                            <option value='Equatorial Guinea'>Equatorial Guinea</option>
                            <option value='Eritrea'>Eritrea</option>
                            <option value='Estonia'>Estonia</option>
                            <option value='Ethiopia'>Ethiopia</option>
                            <option value='Falkland Islands (Malvinas)'>Falkland Islands (Malvinas)</option>
                            <option value='Faroe Islands'>Faroe Islands</option>
                            <option value='Fiji'>Fiji</option>
                            <option value='Finland'>Finland</option>
                            <option value='France'>France</option>
                            <option value='French Guiana'>French Guiana</option>
                            <option value='French Polynesia'>French Polynesia</option>
                            <option value='French Southern Territories'>French Southern Territories</option>
                            <option value='Gabon'>Gabon</option>
                            <option value='Gambia'>Gambia</option>
                            <option value='Georgia'>Georgia</option>
                            <option value='Germany'>Germany</option>
                            <option value='Ghana'>Ghana</option>
                            <option value='Gibraltar'>Gibraltar</option>
                            <option value='Greece'>Greece</option>
                            <option value='Greenland'>Greenland</option>
                            <option value='Grenada'>Grenada</option>
                            <option value='Guadeloupe'>Guadeloupe</option>
                            <option value='Guam'>Guam</option>
                            <option value='Guatemala'>Guatemala</option>
                            <option value='Guernsey'>Guernsey</option>
                            <option value='Guinea'>Guinea</option>
                            <option value='Guinea-Bissau'>Guinea-Bissau</option>
                            <option value='Guyana'>Guyana</option>
                            <option value='Haiti'>Haiti</option>
                            <option value='Heard Island and Mcdonald Islands'>Heard Island and Mcdonald Islands</option>
                            <option value='Holy See (Vatican City State)'>Holy See (Vatican City State)</option>
                            <option value='Honduras'>Honduras</option>
                            <option value='Hong Kong'>Hong Kong</option>
                            <option value='Hungary'>Hungary</option>
                            <option value='Iceland'>Iceland</option>
                            <option value='India'>India</option>
                            <option value='Indonesia'>Indonesia</option>
                            <option value='Iran, Islamic Republic of'>Iran, Islamic Republic of</option>
                            <option value='Iraq'>Iraq</option>
                            <option value='Ireland'>Ireland</option>
                            <option value='Isle of Man'>Isle of Man</option>
                            <option value='Israel'>Israel</option>
                            <option value='Italy'>Italy</option>
                            <option value='Jamaica'>Jamaica</option>
                            <option value='Japan'>Japan</option>
                            <option value='Jersey'>Jersey</option>
                            <option value='Jordan'>Jordan</option>
                            <option value='Kazakhstan'>Kazakhstan</option>
                            <option value='Kenya'>Kenya</option>
                            <option value='Kiribati'>Kiribati</option>
                            <option value='Korea, Democratic People's Republic of'>Korea, Democratic People's Republic of</option>
                            <option value='Korea, Republic of'>Korea, Republic of</option>
                            <option value='Kosovo'>Kosovo</option>
                            <option value='Kuwait'>Kuwait</option>
                            <option value='Kyrgyzstan'>Kyrgyzstan</option>
                            <option value='Lao People's Democratic Republic'>Lao People's Democratic Republic</option>
                            <option value='Latvia'>Latvia</option>
                            <option value='Lebanon'>Lebanon</option>
                            <option value='Lesotho'>Lesotho</option>
                            <option value='Liberia'>Liberia</option>
                            <option value='Libyan Arab Jamahiriya'>Libyan Arab Jamahiriya</option>
                            <option value='Liechtenstein'>Liechtenstein</option>
                            <option value='Lithuania'>Lithuania</option>
                            <option value='Luxembourg'>Luxembourg</option>
                            <option value='Macao'>Macao</option>
                            <option value='Macedonia, the Former Yugoslav Republic of'>Macedonia, the Former Yugoslav Republic of</option>
                            <option value='Madagascar'>Madagascar</option>
                            <option value='Malawi'>Malawi</option>
                            <option value='Malaysia'>Malaysia</option>
                            <option value='Maldives'>Maldives</option>
                            <option value='Mali'>Mali</option>
                            <option value='Malta'>Malta</option>
                            <option value='Marshall Islands'>Marshall Islands</option>
                            <option value='Martinique'>Martinique</option>
                            <option value='Mauritania'>Mauritania</option>
                            <option value='Mauritius'>Mauritius</option>
                            <option value='Mayotte'>Mayotte</option>
                            <option value='Mexico'>Mexico</option>
                            <option value='Micronesia, Federated States of'>Micronesia, Federated States of</option>
                            <option value='Moldova, Republic of'>Moldova, Republic of</option>
                            <option value='Monaco'>Monaco</option>
                            <option value='Mongolia'>Mongolia</option>
                            <option value='Montenegro'>Montenegro</option>
                            <option value='Montserrat'>Montserrat</option>
                            <option value='Morocco'>Morocco</option>
                            <option value='Mozambique'>Mozambique</option>
                            <option value='Myanmar'>Myanmar</option>
                            <option value='Namibia'>Namibia</option>
                            <option value='Nauru'>Nauru</option>
                            <option value='Nepal'>Nepal</option>
                            <option value='Netherlands'>Netherlands</option>
                            <option value='Netherlands Antilles'>Netherlands Antilles</option>
                            <option value='New Caledonia'>New Caledonia</option>
                            <option value='New Zealand'>New Zealand</option>
                            <option value='Nicaragua'>Nicaragua</option>
                            <option value='Niger'>Niger</option>
                            <option value='Nigeria'>Nigeria</option>
                            <option value='Niue'>Niue</option>
                            <option value='Norfolk Island'>Norfolk Island</option>
                            <option value='Northern Mariana Islands'>Northern Mariana Islands</option>
                            <option value='Norway'>Norway</option>
                            <option value='Oman'>Oman</option>
                            <option value='Pakistan'>Pakistan</option>
                            <option value='Palau'>Palau</option>
                            <option value='Palestinian Territory, Occupied'>Palestinian Territory, Occupied</option>
                            <option value='Panama'>Panama</option>
                            <option value='Papua New Guinea'>Papua New Guinea</option>
                            <option value='Paraguay'>Paraguay</option>
                            <option value='Peru'>Peru</option>
                            <option value='Philippines'>Philippines</option>
                            <option value='Pitcairn'>Pitcairn</option>
                            <option value='Poland'>Poland</option>
                            <option value='Portugal'>Portugal</option>
                            <option value='Puerto Rico'>Puerto Rico</option>
                            <option value='Qatar'>Qatar</option>
                            <option value='Reunion'>Reunion</option>
                            <option value='Romania'>Romania</option>
                            <option value='Russian Federation'>Russian Federation</option>
                            <option value='Rwanda'>Rwanda</option>
                            <option value='Saint Barthelemy'>Saint Barthelemy</option>
                            <option value='Saint Helena'>Saint Helena</option>
                            <option value='Saint Kitts and Nevis'>Saint Kitts and Nevis</option>
                            <option value='Saint Lucia'>Saint Lucia</option>
                            <option value='Saint Martin'>Saint Martin</option>
                            <option value='Saint Pierre and Miquelon'>Saint Pierre and Miquelon</option>
                            <option value='Saint Vincent and the Grenadines'>Saint Vincent and the Grenadines</option>
                            <option value='Samoa'>Samoa</option>
                            <option value='San Marino'>San Marino</option>
                            <option value='Sao Tome and Principe'>Sao Tome and Principe</option>
                            <option value='Saudi Arabia'>Saudi Arabia</option>
                            <option value='Senegal'>Senegal</option>
                            <option value='Serbia'>Serbia</option>
                            <option value='Serbia and Montenegro'>Serbia and Montenegro</option>
                            <option value='Seychelles'>Seychelles</option>
                            <option value='Sierra Leone'>Sierra Leone</option>
                            <option value='Singapore'>Singapore</option>
                            <option value='Sint Maarten'>Sint Maarten</option>
                            <option value='Slovakia'>Slovakia</option>
                            <option value='Slovenia'>Slovenia</option>
                            <option value='Solomon Islands'>Solomon Islands</option>
                            <option value='Somalia'>Somalia</option>
                            <option value='South Africa'>South Africa</option>
                            <option value='South Georgia and the South Sandwich Islands'>South Georgia and the South Sandwich Islands</option>
                            <option value='South Sudan'>South Sudan</option>
                            <option value='Spain'>Spain</option>
                            <option value='Sri Lanka'>Sri Lanka</option>
                            <option value='Sudan'>Sudan</option>
                            <option value='Suriname'>Suriname</option>
                            <option value='Svalbard and Jan Mayen'>Svalbard and Jan Mayen</option>
                            <option value='Swaziland'>Swaziland</option>
                            <option value='Sweden'>Sweden</option>
                            <option value='Switzerland'>Switzerland</option>
                            <option value='Syrian Arab Republic'>Syrian Arab Republic</option>
                            <option value='Taiwan, Province of China'>Taiwan, Province of China</option>
                            <option value='Tajikistan'>Tajikistan</option>
                            <option value='Tanzania, United Republic of'>Tanzania, United Republic of</option>
                            <option value='Thailand'>Thailand</option>
                            <option value='Timor-Leste'>Timor-Leste</option>
                            <option value='Togo'>Togo</option>
                            <option value='Tokelau'>Tokelau</option>
                            <option value='Tonga'>Tonga</option>
                            <option value='Trinidad and Tobago'>Trinidad and Tobago</option>
                            <option value='Tunisia'>Tunisia</option>
                            <option value='Turkey'>Turkey</option>
                            <option value='Turkmenistan'>Turkmenistan</option>
                            <option value='Turks and Caicos Islands'>Turks and Caicos Islands</option>
                            <option value='Tuvalu'>Tuvalu</option>
                            <option value='Uganda'>Uganda</option>
                            <option value='Ukraine'>Ukraine</option>
                            <option value='United Arab Emirates'>United Arab Emirates</option>
                            <option value='United Kingdom'>United Kingdom</option>
                            <option value='United States'>United States</option>
                            <option value='United States Minor Outlying Islands'>United States Minor Outlying Islands</option>
                            <option value='Uruguay'>Uruguay</option>
                            <option value='Uzbekistan'>Uzbekistan</option>
                            <option value='Vanuatu'>Vanuatu</option>
                            <option value='Venezuela'>Venezuela</option>
                            <option value='Viet Nam'>Viet Nam</option>
                            <option value='Virgin Islands, British'>Virgin Islands, British</option>
                            <option value='Virgin Islands, U.s.'>Virgin Islands, U.s.</option>
                            <option value='Wallis and Futuna'>Wallis and Futuna</option>
                            <option value='Western Sahara'>Western Sahara</option>
                            <option value='Yemen'>Yemen</option>
                            <option value='Zambia'>Zambia</option>
                            <option value='Zimbabwe'>Zimbabwe</option>
                        </select>
                        <label class="form-label" for="pais">Pais</label>
                    </div>
                    <div class="d-flex justify-content-end pt-3">
                    <div class="mb-3"></div><button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);border-color: rgb(86,198,198);">Adicionar Morada</button>
                    </div>   
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
}
else{
    ?>
    <main class="page contact-us-page">
    <section class="clean-block clean-form dark">
        <div class="container" style="color: var(--bs-blue);">
            <div class="block-heading">
                <h2 style="color: rgb(86,198,198);">Adicionar e ver Moradas</h2>
                <p style="color: rgb(0,0,0);">Aqui pode ver as suas moradas e adicionar novas</p>
            </div>
        </div>
        <div class="container text-center" style="padding: 1%;"><a href="moradas.php?addMoradas=1"><button class="btn btn-primary" type="button" style="background: rgb(86,198,198);width: 25%;border-color: rgb(86,198,198);border-top-color: rgb(86,198,198);">Adicionar Moradas</button></a></div>
       <div class="container text-center" style="padding: 1%;"><a href="moradas.php?verMoradas=1"><button class="btn btn-primary" type="button" style="background: rgb(86,198,198);width: 25%;border-color: rgb(86,198,198);border-top-color: rgb(86,198,198);">Ver Moradas</button></a></div>
    </section>
</main>
<?php
}

?>  
<footer class="footer-basic">
    <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="index.php">Home</a></li>
            <li class="list-inline-item"><a href="#">Services</a></li>
            <li class="list-inline-item"><a href="#">About</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
        </ul>
    <p class="copyright">Book WareHouse © 2022</p>
</footer>

</form>
</body>
</html>