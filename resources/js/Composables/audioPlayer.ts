import { ref, computed } from "vue";

const currentMusicToPlay = ref<HTMLAudioElement | null>(null);
const rawTime = ref(0);
const rawDuration = computed(() => currentMusicToPlay.value?.duration ?? 0);
const isPlaying = ref(false);

function formatTime(time: number) {
    const minutes = Math.floor(time / 60);
    const seconds = Math.floor(time % 60);
    return `${minutes}:${seconds < 10 ? "0" + seconds : seconds}`;
}

const currentTimeString = computed(() => formatTime(rawTime.value));

const currentDurationString = computed(() => formatTime(rawDuration.value));

function updateCurrentTime() {
    if (currentMusicToPlay.value) {
        rawTime.value = currentMusicToPlay.value.currentTime;
    }
    if (isPlaying.value) requestAnimationFrame(updateCurrentTime);
}

function pause() {
    if (currentMusicToPlay.value) {
        currentMusicToPlay.value.pause();
        isPlaying.value = false;
    }
}

function play() {
    if (currentMusicToPlay.value) {
        currentMusicToPlay.value.play();
        isPlaying.value = true;
        updateCurrentTime();
    }
}

function requestPlay(audio: HTMLAudioElement) {
    if (currentMusicToPlay.value) {
        if (currentMusicToPlay.value === audio) {
            if (isPlaying.value) {
                pause();
            } else {
                play();
            }
        } else {
            pause();
            currentMusicToPlay.value = audio;
            play();
        }
    } else {
        currentMusicToPlay.value = audio;
        play();
    }
}

export const useAudioPlayer = () => {
    return {
        requestPlay,
        isPlaying,
        currentTimeString,
        currentDurationString,
        rawTime,
        rawDuration,
        pause,
        play,
    };
};
