$(document).ready(function(){
    var h3=document.getElementsByTagName("h3")[0];
    var form=document.getElementsByTagName("form")[0];
    $("#entreprise-type-btn").click(function(){
        form.innerHTML=entreprise;
        h3.innerHTML="Inscription(Entreprise)";
    });
    $("#commissaire-type-btn").click(function(){
        form.innerHTML=commissaire;
        h3.innerHTML="Inscription(Commissaire priseur)";
    })
});






























var commissaire= ` 
        <div class="container">
        <div class="row">
        <div class="col-md-4">
            <div class="form-group">
            <label for="lastname">Prénom:</label>
            <input type="text" class="form-control" id="prenom" name="prenom">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <label for="name">Nom:</label>
            <input type="text" class="form-control" id="name" name="nom" placeholder=" Doe" size="">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <label for="number">Numéro téléphone:</label>
            <input type="tel" class="form-control" id="number" name="numero" size="10" maxlength="20">
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="kelenfila@gmail.com">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
            <label for="city">Ville:</label>
            <input type="text" class="form-control" id="city" name="ville" size="15">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
            <label for="country">Pays:</label>
            <select class="form-control" name="pays" id="country">
                <option value="Côte d'ivoire">Côte d'ivoire</option>
                <option value="Senegal">Senegal</option>
                <option value="Mali">Mali</option>
                <option value="Benin">Benin</option>
                <option value="Togo">Togo</option>
                <option value="Niger">Niger</option>
                <option value="Guinée-Bissau">Guinée-Bissau</option>
            </select>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-4">
            <div class="form-group">
            <label for="adress">Adresse:</label>
            <input type="text" class="form-control" id="adress" name="adresse" placeholder="BP17 ABIDJAN 17" size="">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input type="password" class="form-control" id="password" name="password">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <input type="hidden" name="q" value="sign">
            <input type="hidden" name="t" value="commissaire">
            
            <label for="repassword">Confirmation Mot de passe:</label>
            <input type="password" class="form-control" id="repassword" name="password-confirm">
            </div>
        </div>
        </div>
        </div>


        <div class=" d-flex justify-content-center"><p><input type="radio" name="accord" value="yes" id="wish"> <label for="wish">En continuant l'utilisation vous acceptez
            les <a href="#" style=" color: black;">contrats de licence</a> de KenFilah</label></p>
        </div>

        </div>
        <div class="d-flex justify-content-center  my-5">
            <div id="button-container" class="text-center">
                <button type="submit" type="submit" id="submit" value="submit" id="submit" >S'inscrire</button>
            </div>
        </div>

    `;

var entreprise=`
<div class="container">
<div class="form-group">
    <div class="row" >
        <div class="col-md-4">
            <div class="form-group">
                <label for="society_name">Nom de Société</label>  
                <input class="form-control"  type="text" id="society_name" name="nomEntreprise" >
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <label for="country">Pays:</label>
            <select class="form-control" name="pays" id="country">
                <option value="Côte d'ivoire">Côte d'ivoire</option>
                <option value="Senegal">Senegal</option>
                <option value="Mali">Mali</option>
                <option value="Benin">Benin</option>
                <option value="Togo">Togo</option>
                <option value="Niger">Niger</option>
                <option value="Guinée-Bissau">Guinée-Bissau</option>
            </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="city">Ville</label>  
                <input class="form-control"  type="text" id="city" name="ville" placeholder = "Man" size="15">
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-md-6">
            <div class="form-group">
                <label for="adress">Adresse</label> 
                <input class="form-control"  type="text" id="adress" name="adresse" placeholder = "BP07 Man 07" size="">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="name">Nom</label>  
                <input class="form-control"  type="text" id="name" name="nom" size="" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="prenom">Prénom</label>  
                <input class="form-control"  type="text" id="prenom" name="prenom" >
            </div>
        </div>
    <input type="hidden" name="q" value="sign">
    <input type="hidden" name="t" value="enterprise">
    </div>
    <div class="row" >
        <div class="col-md-3">
            <div class="form-group">
                <label for="function">Poste dans l'entreprise</label>  
                <input class="form-control"  type="text" id="function" name="poste">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
            <label for="number">Numéro téléphone:</label>
            <input type="tel" class="form-control" id="number" name="numero" size="10" maxlength="20">
        </div>
</div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email</label> <input class="form-control"  type="email" id="email" name="email" placeholder = "entreprise@gmail.com" >
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-md-6">
            <div class="form-group">
                <label for="password">Mot de passe</label> 
                <input class="form-control"  type="password" id="password" name="password" placeholder = "" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="repassword">Confirmation Mot de passe</label> 
                <input class="form-control"  type="password" id="repassword" name="password-confirm" >
            </div>
        </div>
    </div>
    <div class="row" id="last-row" >
        <input type="radio" name="accord" value="yes" id="wish"> 
        <label id="lbl" for="wish">En continuant l'utilisation vous acceptez
            les <a href="#" style=" color: black;">contrats de licence</a> de KenFilah</label>
        
    </div>
</div>


</div>
<div class="d-flex justify-content-center my-5">
<div id="button-container" class="text-center">
    <button type="submit" type="submit" id="submit" value="submit" id="submit" >S'inscrire</button>
</div>
</div>

`;