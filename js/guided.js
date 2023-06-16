
const tour = new Shepherd.tour({
    defaultStepOptions: {
        cancelIcon: {
            enabled: true
        },

        classes: 'shepherd-theme-arrows'
    }
});

tour.addstep({
    text: "I'm Emran and welcome to kaagapAI! I will be guiding you today as we navigate through all the features and make the most out of your experience with us. Let's dive in and start exploring together!",
    attachTo: {
        element: '.menu',
        on: 'right'
    },
    buttons: [{
        text: 'Next'
    }],
})

tour.start();