<script>

    let mediaRecorder;
    let chunks = [];

    const startRecordingBtn = document.getElementById("start-recording");
    const stopRecordingBtn = document.getElementById("stop-recording");
    const recordedAudio = document.getElementById("recorded-audio");
    startRecordingBtn.addEventListener("click", function() {

        startRecordingBtn.setAttribute("disabled", true);
        stopRecordingBtn.removeAttribute("disabled");

        navigator.mediaDevices.getUserMedia({ audio: true })
            .then(stream => {
                mediaRecorder = new MediaRecorder(stream);
                mediaRecorder.start();
                mediaRecorder.addEventListener("dataavailable", event => {
                    chunks.push(event.data);
                });
            })
            .catch(error => {
                console.error(error);
            });
    });

    // Handle stop recording button click
    stopRecordingBtn.addEventListener("click", function() {

        mediaRecorder.stop();

        stopRecordingBtn.setAttribute("disabled", true);
        startRecordingBtn.removeAttribute("disabled");

        const audioBlob = new Blob(chunks);
        const audioUrl = URL.createObjectURL(audioBlob);

        recordedAudio.src = audioUrl;
        recordedAudio.play();

        var formData = new FormData();
        formData.append("audio", audioBlob);
        axios.post('/audio-upload', formData).then((response) => {
            console.log(response);
        });
    });
</script>
