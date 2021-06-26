$(document).ready(function() {
    if (window.location.pathname == "/index.php") {
        audio_select = document.getElementById("audio_output").children[0];
        audio_select.addEventListener("change", audio_output_changed);

        raw_player_select = document.getElementsByName("RAW_PLAYER")[0];
        raw_player_select.addEventListener("change", adjust_lms);

        squeezelite_checkbox = document.getElementsByName("JACK_SQUEEZELITE")[1];
        squeezelite_checkbox.addEventListener("change", adjust_lms);

        adjust_audio_matrix();
        adjust_sample_rate_select();
        adjust_lms();
    }

    if (window.location.pathname == "/brutefir.php") {
        var current_output = document.getElementById("convolver_settings").dataset.output;
        if (current_output == "jack-bf" || current_output == "jack-bfms") {
            $("#convolver_settings *").prop("disabled", false);
        } else {
            $("#convolver_settings *").prop("disabled", true);
        }
    }
});

// Triggered when the audio output is changed
function audio_output_changed() {
    adjust_audio_matrix();
    adjust_sample_rate_select();
    adjust_lms();
}

function adjust_audio_matrix() {
    reset_audio_matrix();
    var selected_output = audio_select.value;
    switch(selected_output) {
        case "vol-plug":
            var help_direct = document.getElementById("help_audio_output").dataset.direct;
            document.getElementById("help_audio_output").setAttribute("title", help_direct);
            document.getElementById("player_raw").classList.remove("d-none");
            break;
        case "jack":
            var help_bus = document.getElementById("help_audio_output").dataset.bus;
            document.getElementById("help_audio_output").setAttribute("title", help_bus);
            document.getElementById("output_headline_title").classList.remove("d-none");
            document.getElementById("output_headline").classList.remove("d-none");
            document.getElementById("output_mixer").classList.remove("d-none");
            break;
        case "jack-bf":
            var help_convol = document.getElementById("help_audio_output").dataset.convol;
            document.getElementById("help_audio_output").setAttribute("title", help_convol);
            document.getElementById("output_headline_title").classList.remove("d-none");
            document.getElementById("output_headline").classList.remove("d-none");
            document.getElementById("output_mixer").classList.remove("d-none");
            break;
    }
}

function reset_audio_matrix() {
    document.getElementById("player_raw").classList.add("d-none");

    document.getElementById("output_headline_title").classList.add("d-none");
    document.getElementById("output_headline").classList.add("d-none");

    document.getElementById("output_mixer").classList.add("d-none");

    document.getElementById("help_audio_output").setAttribute("title", "");
}

// Shows/hides both sample rate select and hint depending on chosen output
function adjust_sample_rate_select() {
    let rate_select = document.getElementsByName("RATE")[0];
    let rate_direct = document.getElementById("rate_direct");
    let selected_output = audio_select.value;
    if (selected_output == "vol-plug" || selected_output == "vol-plug-ms") {
        rate_select.classList.add("d-none");
        rate_direct.classList.remove("d-none");
    } else {
        rate_select.classList.remove("d-none");
        rate_direct.classList.add("d-none");
    }
}

function adjust_lms() {
    let selected_output = audio_select.value;
    let raw_player = raw_player_select.value;
    let squeeze_enabled = squeezelite_checkbox.checked;

    if (selected_output == "vol-plug" || selected_output == "vol-plug-ms") {
        if (raw_player == "squeezelite") {
            $("#lms_settings *").prop("disabled", false);
        } else {
            $("#lms_settings *").prop("disabled", true);
        }

    } else {
        if (squeeze_enabled) {
            $("#lms_settings *").prop("disabled", false);
        } else {
            $("#lms_settings *").prop("disabled", true);
        }
    }
}

// Checkbox zum Passwort anzeigen
function machText(chk, frm) {
    var p = frm.newpass;
    try {
        var val = p.value;
        p.type = chk ? 'text':'password';
        p.value = val; //benötigt z. B. in Opera
    }
    catch (e) {
        var neuInp=document.createElement('input');
        neuInp.type = chk ? 'text':'password';
        neuInp.value = p.value;
        neuInp.name = neuInp.id = 'newpass';
        p.parentNode.replaceChild(neuInp,p);
    }
}