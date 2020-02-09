
<article class = "formulaire" data-js-formulaire-commande>
    <form action="" method="POST">
    <button class="btn-close" data-js-close-form><i class="fas fa-times"></i></button>
    <fieldset>
            <legend>Votre identité</legend>
            <ul>
                <li>
                    <label for="nom_client">Nom* :</label>
                    <div>
                        <input id="nom_client" 
                        type="text"
                        name="nom"
                        required
                        data-js-champ-nom><span></span>
                    </div>
                </li>
                <li>
                    <label for="prenom_client">Prénom* :</label>
                    <div>
                        <input id="prenom_client" 
                        type="text" 
                        name="prenom"
                        required
                        data-js-champ-prenom><span></span>
                    </div>
                </li>
                <li>
                    <label for="courriel">Courriel* :</label>
                    <div>
                        <input id="courriel" 
                        type="text" 
                        name="courriel"
                        pattern="(.+)@(.+){1,}\.(.+){1,}"
                        required
                        data-message-erreur = "Entrez un courriel valide !"
                        data-js-champ-courriel><span></span>
                        <p>votrecourriel@xyz.ccc</p>
                    </div>
                </li>
            </ul>
        </fieldset>
        <fieldset>
            <legend>Adresse de Livraison</legend>
            <ul>
                <li>
                    <label for="adresse">Adresse* :</label>
                    <div>
                        <input id="adresse" 
                                type="text" 
                                name="adresse"
                                required
                                data-js-champ-adresse><span></span>
                                <p>votre rue , votre ville</p>
                    </div>
                </li>
                <li>
                    <label for="CP">Code Postal* :</label>
                    <div>
                        <input id="CP" 
                        type="text" 
                        name="CP"
                        pattern="[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d"
                        required
                        data-message-erreur = "Entrez un code de type A1B 2C3 !"
                        data-mask = "a0a-0a0"
                        data-js-champ-CP><span></span>
                        <p>format A0A-0A0</p>
                    </div>
                </li>
            </ul>
        </fieldset>
        <fieldset>
            <legend>Mode de Paiement</legend>
            <ul>
                <li>
                    <fieldset>
                        <legend>Type de carte bancaire*</legend>
                        <ul>
                            <li>
                                <input id="visa" 
                                    name="type_de_carte" 
                                    type="radio"
                                    data-js-radio-cb = "visa"
                                    data-placeholder = "4000-0000-0000-0000"
                                    data-pattern = "4[0-9]{3}-[0-9]{4}-[0-9]{4}-[0-9]{4}"
                                    data-message-erreur="Ne correspond pas au type VISA !">
                                <label for="visa"><i class="fab fa-cc-visa"></i> Visa</label>
                            </li>
                            <li>
                                <input id="mastercard" 
                                    name="type_de_carte" 
                                    type="radio"
                                    data-js-radio-cb = "mastercard"
                                    data-placeholder = "5500-0000-0000-0000"
                                    data-pattern = "5[1-5][0-9]{2}-[0-9]{4}-[0-9]{4}-[0-9]{4}"
                                    data-message-erreur="Ne correspond pas au type MASTERCARD !">
                                <label for="mastercard"><i class="fab fa-cc-mastercard"></i> Mastercard</label>
                            </li>
                            <li>
                                <input id="essai" 
                                    name="type_de_carte" 
                                    type="radio"
                                    data-js-radio-cb = "essai"
                                    data-placeholder = "0000-0000-0000-0000"
                                    data-pattern = "[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}"
                                    data-message-erreur="Ne correspond pas au type ESSAI !">
                                <label for="essai"><i class="far fa-credit-card"></i> (pattern permissif)</label>
                            </li>
                        </ul>
                        <label for="CB">n° carte de crédit*:</label>
                        <div>
                            <!-- le pattern a besoin d'être initialiser à une fausse valeur pour pouvoir afficher un message d'erreur si le champ n'a pas été rempli -->
                            <input id="CB" 
                                    type="text" 
                                    name="CB"
                                    pattern="[123]"
                                    required
                                    disabled
                                    data-message-erreur="Choisir un type de carte ! "
                                    data-mask="0000-0000-0000-0000"
                                    data-js-champ-cb><span></span>
                                    <p data-js-indice-regex>choisir un type de carte</p>
                        </div>
                    </fieldset>
                    </li>
                <li>
                    <label for="expiration">Expiration*:</label>
                    <div>
                        <input id="expiration" 
                                type="text" 
                                name="expiration"
                                pattern="(0[1-9]|1[0-2])\/[0-9]{2}"
                                required
                                data-mask="00/00"
                                data-message-erreur = "Entrez une date de type MM/AA !"
                                data-js-champ-expiration><span></span>
                                <p>format MM/AA</p>
                    </div>
                </li>
                <li>
                    <label for="code_securite">Code de sécurité* :</label>
                    <div>
                        <input id="code_securite" 
                                type="password" 
                                name="code_securite"
                                pattern="[0-9]\d\d"
                                required
                                data-mask="000"
                                data-message-erreur="Code Incorrect"
                                data-js-champ-code-securite><span></span>
                                <p>3 chiffres</p>
                    </div>
                </li>
            </ul>
        </fieldset>
        <fieldset class="infolettre">
            <input id="infolettre" 
                type="checkbox" 
                name="infolettre"
                data-js-champ-infolettre>
            <label for="infolettre">S'inscrire à l'infolettre</label>
        </fieldset>
        <input type="submit"
        class="bouton-submit"
        value="Soumettre"
        data-js-submit>
    </form>
</article>