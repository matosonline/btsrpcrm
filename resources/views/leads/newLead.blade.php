@extends('layout.mainlayout')

@section('content')

@if(count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

    <div class="card col-8 mx-auto p-3">

        <form action="{{ route('lead.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fName">First Name</label>
                    <input type="text" name="fName" class="form-control" id="fName" placeholder="First Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="lName">Last Name</label>
                    <input type="text" name="lName" class="form-control" id="lName" placeholder="Last Name">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input class="form-control" type="date" name="dob" id="dob">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" name="inputAddress" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input type="text" name="inputAddress2" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" name="inputCity" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select name="inputState" id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option value="1">AL</option>
                        <option value="2">AK</option>
                        <option value="3">AZ</option>
                        <option value="4">AR</option>
                        <option value="5">CA</option>
                        <option value="6">CO</option>
                        <option value="7">CT</option>
                        <option value="8">DE</option>
                        <option value="9">DC</option>
                        <option value="10">FL</option>
                        <option value="11">GA</option>
                        <option value="12">HI</option>
                        <option value="13">ID</option>
                        <option value="14">IL</option>
                        <option value="15">IN</option>
                        <option value="16">IA</option>
                        <option value="17">KS</option>
                        <option value="18">KY</option>
                        <option value="19">LA</option>
                        <option value="20">ME</option>
                        <option value="21">MD</option>
                        <option value="22">MA</option>
                        <option value="23">MI</option>
                        <option value="24">MN</option>
                        <option value="25">MS</option>
                        <option value="26">MO</option>
                        <option value="27">MT</option>
                        <option value="28">NE</option>
                        <option value="29">NV</option>
                        <option value="30">NH</option>
                        <option value="31">NJ</option>
                        <option value="32">NM</option>
                        <option value="33">NY</option>
                        <option value="34">NC</option>
                        <option value="35">ND</option>
                        <option value="36">OH</option>
                        <option value="37">OK</option>
                        <option value="38">OR</option>
                        <option value="39">PA</option>
                        <option value="40">RI</option>
                        <option value="41">SC</option>
                        <option value="42">SD</option>
                        <option value="43">TN</option>
                        <option value="44">TX</option>
                        <option value="45">UT</option>
                        <option value="46">VT</option>
                        <option value="47">VA</option>
                        <option value="48">WA</option>
                        <option value="49">WV</option>
                        <option value="50">WI</option>
                        <option value="51">WY</option>
                        <option value="52">AS</option>
                        <option value="53">PR</option>
                        <option value="54">VI</option>
                        <option value="55">GU</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" name="inputZip" class="form-control" id="inputZip">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <label for="phone1">Phone Number</label>
                    <input type="text" name="phone1" class="form-control" id="phone1" placeholder="Phone Number">
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-6">
                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="agreeOrDisagree" id="agree" value="1" checked>
                                <label class="form-check-label" for="agree">
                                    Agree
                                </label>
                            </div>
                            <div>
                                <p>I spoke to the patient and expressly asked if I have their permission to provide their name and phone number to an agent that will call them to discuss benefit options and patient confirmed.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="agreeOrDisagree" id="disagree" value="2">
                                <label class="form-check-label" for="disagree">
                                    Do NOT Agree
                                </label>
                            </div>
                            <div>
                                <p>Patient opted out of receiving a call regarding health plan options.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="planType">Plan Type</label>
                            <select name="planType" class="custom-select">
                                <option value="0" default>Other - Not Humana</option>
                                <option value="1">Humana Commercial HMO/PPO</option>
                                <option value="2">Humana Medicare HMO/PPO</option>
                                <option value="3">Humana Medicaid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pcpName">PCP Name</label>
                            <select name="pcpName" class="custom-select">
                                <option value="null">SELECT...</option>
                                <option value="0"> PCP not listed, see note...</option>
                                <option value="1">	ACEVEDO, RICARDO A, APRN-C	</option>
                                <option value="2">	ADAN, LETICIA, MD	</option>
                                <option value="3">	AGHIGH, SOROUSH, MD	</option>
                                <option value="4">	AMADOR-DEL VALLE, ESTHER, DO	</option>
                                <option value="5">	ANDRADE, AGUSTIN A, MD	</option>
                                <option value="6">	AQUININ, RONNY V, MD	</option>
                                <option value="7">	ARENAS, IVAN A, MD	</option>
                                <option value="8">	ARMENTEROS, REBECA , DO	</option>
                                <option value="9">	ASUNCION, ANNA , MD	</option>
                                <option value="10">	AVALOS PENA, ANNEYD, MD	</option>
                                <option value="11">	BAKER, JEFFREY, DO	</option>
                                <option value="12">	BENAVIDES, MIGUEL A, MD	</option>
                                <option value="13">	BERGER, RICHARD A, MD	</option>
                                <option value="14">	BICHACHI, ABRAHAM, MD	</option>
                                <option value="15">	BIRNBAUM, VIVIAN S, MD	</option>
                                <option value="16">	BRANCALE, PETER, MD	</option>
                                <option value="17">	BUCHILLON, GEOBEL, APRN-C	</option>
                                <option value="18">	CABALLERO, ORLANDO G, MD	</option>
                                <option value="19">	CABALLES, MARCIANA J, APRN	</option>
                                <option value="20">	CANAS, ALBERT, MD	</option>
                                <option value="21">	CASSIS, DANIEL L, MD	</option>
                                <option value="22">	CASTANEIRA, GISELLE, MD	</option>
                                <option value="23">	CASTELLANOS MATEUS, PATRICIA, MD	</option>
                                <option value="24">	CENTURION, JOSE J, MD	</option>
                                <option value="25">	CLAVIJO, LILIANA C, PA-C	</option>
                                <option value="26">	COHEN, JANE S, MD	</option>
                                <option value="27">	COLLAZO, EDITA E, APRN-C	</option>
                                <option value="28">	CONCEPCION, GILBERT G, MD	</option>
                                <option value="29">	CONDE, CESAR A, MD	</option>
                                <option value="30">	COSTA ARMAS, PAVEL, APRN,DNP	</option>
                                <option value="31">	CUELLAR, JUAN M, MD	</option>
                                <option value="32">	CUELLO FUENTES, RICHARD, MD	</option>
                                <option value="33">	CURRY, SABRINA M, APRN-C	</option>
                                <option value="34">	DA COSTA, JONATHAN R, MD	</option>
                                <option value="35">	DASAYEV, RUFAT, APRN-C	</option>
                                <option value="36">	DE CABRERA, CARLOS E, APRN-C	</option>
                                <option value="37">	DEL VALLE, ALEJANDRO, DO	</option>
                                <option value="38">	DENHAM, MISHA , DO	</option>
                                <option value="39">	DESIR, RANLEY M, MD	</option>
                                <option value="40">	DI PIETRO, OLIVER R, MD	</option>
                                <option value="41">	DIAZ REYES, KAREL, MD	</option>
                                <option value="42">	DIAZ VALDES, JORGE, MD	</option>
                                <option value="43">	DIAZ, MARIA A, DO	</option>
                                <option value="44">	DOMINGUEZ, MANUEL, MD	</option>
                                <option value="45">	DROST, MARTIN J, MD	</option>
                                <option value="46">	DUMENIGO, RODOLFO, MD	</option>
                                <option value="47">	DUQUESNAY, DANIELLE A, PA-C	</option>
                                <option value="48">	ELGOZY, JACOBO, DO	</option>
                                <option value="49">	ELKAYAM, LIOR U, MD	</option>
                                <option value="50">	ELMAHDY, HANY M, MD	</option>
                                <option value="51">	ESCOLAR, ESTEBAN, MD	</option>
                                <option value="52">	ESTRIN, LILI, MD	</option>
                                <option value="53">	FERNANDEZ, ANTONIO, MD	</option>
                                <option value="54">	FERNANDEZ, RAFLE, MD MBA	</option>
                                <option value="55">	FRANKFURT, SEYMOUR J, MD	</option>
                                <option value="56">	FUENTES, FRANCISCO, MD	</option>
                                <option value="57">	GADEA, LIVIA C, MD	</option>
                                <option value="58">	GALERA, FELIX J, APRN-C	</option>
                                <option value="59">	GALLAGHER, APRIL, APRN-C	</option>
                                <option value="60">	GANGERI, NATASSJA, DO	</option>
                                <option value="61">	GARDINER, NATALIE, MD	</option>
                                <option value="62">	GEORGE, ELISA O, MD	</option>
                                <option value="63">	GLICKSMAN, FRANCES L, MD	</option>
                                <option value="64">	GOLD SCHEIN, ANDREA S, MD	</option>
                                <option value="65">	GOLDSAND, CARL S, MD	</option>
                                <option value="66">	GOLDSZER, ROBERT C, MD MBA	</option>
                                <option value="67">	GONZALEZ JR, JESUS, MD	</option>
                                <option value="68">	GONZALEZ OCHOA, ALBA M, MD	</option>
                                <option value="69">	GONZALEZ, JORGE A, DO	</option>
                                <option value="70">	GONZALEZ, SUSANA, MD	</option>
                                <option value="71">	GRATZ, CHARLES J, MD	</option>
                                <option value="72">	GUERRA DEL CASTILLO, ROBERTO , MD	</option>
                                <option value="73">	HALES, ALLISON M, DO	</option>
                                <option value="74">	HARRIS, ANDREW S, DO	</option>
                                <option value="75">	HERNANDEZ, LARISSA , MD	</option>
                                <option value="76">	HERNANDEZ, LYNN M, DO	</option>
                                <option value="77">	HODZIC, EMIN , DO	</option>
                                <option value="78">	HOMAN, JOAN E, MD	</option>
                                <option value="79">	HOROWITZ, MICHAEL E, MD	</option>
                                <option value="80">	HORVATH ADAM, SOFIA, MD	</option>
                                <option value="81">	IMSON, GRACE J, MD	</option>
                                <option value="82">	IRIZARRY-COLON, LEILANY, MD	</option>
                                <option value="83">	JIMENEZ MADRIGAL, JENNIFER ,	</option>
                                <option value="84">	JONAS, IVAN, MD	</option>
                                <option value="85">	JORAPUR, VINOD, MD	</option>
                                <option value="86">	KESHVARI RASTI, HAMID R, MD	</option>
                                <option value="87">	KIRCHNER, CATHERINE M, MD	</option>
                                <option value="88">	KLINGER, SHARI J, MD	</option>
                                <option value="89">	KORN, DAVID, MD	</option>
                                <option value="90">	KOSTOROSKI, ROBERT P, DO	</option>
                                <option value="91">	KULCHINSKY, ROBERT P, MD	</option>
                                <option value="92">	KURY PEREZ, ELIZABETH M, MD	</option>
                                <option value="93">	KUTNER, ALAN R, MD	</option>
                                <option value="94">	LAMAS, GERVASIO A, MD	</option>
                                <option value="95">	LAMPREABE, JOSE G, MD	</option>
                                <option value="96">	LAYKA, AYMAN, MD	</option>
                                <option value="97">	LEMONT, MICHAEL, MD	</option>
                                <option value="98">	LEON, JANELLA, DO	</option>
                                <option value="99">	LEVIN, AMIEL, MD	</option>
                                <option value="100">	LOPEZ GONZALEZ, MARILYN, APRN	</option>
                                <option value="101">	LOPEZ, MARIO, MD	</option>
                                <option value="102">	LOREDO, JORGE A, DO	</option>
                                <option value="103">	LUPU, CORNEL J, MD	</option>
                                <option value="104">	MAGHIDMAN, SAMUEL, MD	</option>
                                <option value="105">	MANGUDO, JEAN-PAUL C, MD	</option>
                                <option value="106">	MANZANO, ALEX J, MD	</option>
                                <option value="107">	MARTINEZ ABELEDO, MARIELA, MD	</option>
                                <option value="108">	MARTINEZ, CARLOS J, APRN-C	</option>
                                <option value="109">	MARTINEZ, RAMON E, MD	</option>
                                <option value="110">	MEDINA, ANITA J, DO	</option>
                                <option value="111">	MEDINA, CLIFFORD E, MD MBA	</option>
                                <option value="112">	MELENDEZ, KATHLEEN, MD	</option>
                                <option value="113">	MERCADE, FERNANDA, MD	</option>
                                <option value="114">	MERLINO, GARY J, DO	</option>
                                <option value="115">	MIHOS, CHRISTOS G, DO	</option>
                                <option value="116">	MILES, ANNE M, MD	</option>
                                <option value="117">	MILLER, GEORGI D, MD	</option>
                                <option value="118">	MITCHELL, ELYANA L, APRN-C	</option>
                                <option value="119">	MORDUJOVICH, JORGE B, MD	</option>
                                <option value="120">	MORENO, ADRIAN, MD	</option>
                                <option value="121">	NADER, ADAM C, MD	</option>
                                <option value="122">	NAISSANCE, WHIDLET, APRN	</option>
                                <option value="123">	NIETO, JOSE G, MD	</option>
                                <option value="124">	NUNEZ BLANCO, EDGAR, MD	</option>
                                <option value="125">	OJEDA, MANUEL A., MD	</option>
                                <option value="126">	PACHTER, BRIAN, DO	</option>
                                <option value="127">	PATINO, IVAN, PA-C	</option>
                                <option value="128">	PAUL, NICOLE M, DO	</option>
                                <option value="129">	PEDOUSSAUT, LAURA, PA-C	</option>
                                <option value="130">	PENA, CARLOS, MD	</option>
                                <option value="131">	PILOTO, MELVYS, APRN-C	</option>
                                <option value="132">	PIPERATO, JOSEPH R, MD	</option>
                                <option value="133">	PUJOL, ISIDRO, DO	</option>
                                <option value="134">	RASKEN, ROBERT J, MD	</option>
                                <option value="135">	REGO, CRYSTAL B, DO	</option>
                                <option value="136">	REINBERG, JAY E, MD	</option>
                                <option value="137">	REINES, ARIEL S, MD	</option>
                                <option value="138">	REYES, MARILIN, APRN-C	</option>
                                <option value="139">	RIOS, JOSE A, MD	</option>
                                <option value="140">	RIVERA, JUAN J, MD	</option>
                                <option value="141">	RODRIGUEZ, RAYMOND, MD	</option>
                                <option value="142">	RUTHERFORD, ROSE A, APRN-C	</option>
                                <option value="143">	SAINTICHE, SYLVANA, APRN	</option>
                                <option value="144">	SALAZAR, ROBERT F, APRN	</option>
                                <option value="145">	SANCHEZ, JAIME J, MD	</option>
                                <option value="146">	SANTANA, ORLANDO, MD	</option>
                                <option value="147">	SANTOS, GUILLERMO, DO	</option>
                                <option value="148">	SAYFIE, EUGENE J, MD	</option>
                                <option value="149">	SCHELLER, VANDHANA M, MD	</option>
                                <option value="150">	SCHNEIDER, NEIL S, MD	</option>
                                <option value="151">	SCHNUR, STEVEN A, MD	</option>
                                <option value="152">	SCORDATO, JR, ROBERT, PA-C	</option>
                                <option value="153">	SELL GRAMATGES, AILEN M, MD	</option>
                                <option value="154">	SHAFFER, CINDY E, MD	</option>
                                <option value="155">	SHAFFER, ROBERT I, MD	</option>
                                <option value="156">	SILVER, CRAIG A, DO	</option>
                                <option value="157">	SOSA, GLENDA, MD	</option>
                                <option value="158">	STEINFELD, ROGER , MD	</option>
                                <option value="159">	SUAREZ BARCELO, MANUEL A, MD	</option>
                                <option value="160">	SUAZA, MARIBEL, APRN	</option>
                                <option value="161">	TAMAYO CHELALA, ANDRE, DO	</option>
                                <option value="162">	TARIQ, EEMAN, MD	</option>
                                <option value="163">	TOLENTINO, ALFONSO O, MD	</option>
                                <option value="164">	TORRES, ANA MARIA, MD	</option>
                                <option value="165">	TROTTER, MAYKEL R, MD	</option>
                                <option value="166">	TROTTER, PAMELA N, MD	</option>
                                <option value="167">	TUKMACHI, EHSSAN, MD	</option>
                                <option value="168">	UGALDE, ISRAEL C, DO	</option>
                                <option value="169">	VEGA, RAFAEL G, MD	</option>
                                <option value="170">	VELAR, ALEXANDER A, MD	</option>
                                <option value="171">	VELASQUEZ, MAIRA Y, APRN-C,DNP	</option>
                                <option value="172">	VELEZ-CALAO, TANIA A, MD	</option>
                                <option value="173">	WEISS, ZACHARY, PA-C	</option>
                                <option value="174">	WILLIAMS, MARJORIE, APRN-C	</option>
                                <option value="175">	WOHLFEILER, MICHAEL B, MD	</option>
                                <option value="176">	WOOLF, ISLON Z, MD	</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea name="notes" class="form-control" id="notes" rows="3"></textarea>
            </div>
            <hr>
            <button type="reset" class="btn btn-danger float-right m-1">Decline</button> <!-- must validate "Are you sure this patient has declined / must correspond with correct selection" -->
            <button type="submit" class="btn btn-success float-right m-1">Add</button> <!-- must correspond with corrent selection above -->
        </form>
    </div>

@endsection

<b></b>
