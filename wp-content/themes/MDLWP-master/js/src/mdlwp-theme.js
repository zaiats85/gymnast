var masonry = new Macy({
    container: '#macy-container',
    trueOrder: false,
    waitForImages: false,
    useOwnImageLoader: false,
    debug: false,
    margin: {
        x: 10,
        y: 10
    },
    columns: 3,
    breakAt: {
        1200: {
            columns: 3,
            margin: {
                x: 5,
                y: 5
            }
        },
        940: {
            columns: 3,
            margin: {
                y: 10,
                x: 10
            }
        },
        520: {
            columns: 3,
            margin: 3
        },
        400: {
            columns: 1
        }
    }
});
