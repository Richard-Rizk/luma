  
    
        function courseCard(course) {
            return `
<div class="col-sm-4 card-group-row__col">

<div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
     data-toggle="popover"
     data-trigger="click">

    <div class="card-body d-flex flex-column">
        <div class="d-flex align-items-center">
            <div class="flex">
                <div class="d-flex align-items-center">
                    <div class="rounded mr-12pt z-0 o-hidden">
                        <div class="overlay">
                            <img src="public/images/paths/react_40x40@2x.png"
                                 width="40"
                                 height="40"
                                 alt="Angular"
                                 class="rounded">
                            <span class="overlay__content overlay__content-transparent">
                                <span class="overlay__action d-flex flex-column text-center lh-1">
                                    <small class="h6 small text-white mb-0"
                                           style="font-weight: 500;">80%</small>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="card-title">${course.courseName}</div>
                        <p class="flex text-50 lh-1 mb-0"><small>18 courses</small></p>
                    </div>
                </div>
            </div>

            <a href="student-path.html"
               data-toggle="tooltip"
               data-title="Add Favorite"
               data-placement="top"
               data-boundary="window"
               class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>

        </div>

    </div>
</div>

<div class="popoverContainer d-none">
    <div class="media">
        <div class="media-left mr-12pt">
            <img src="public/images/paths/react_40x40@2x.png"
                 width="40"
                 height="40"
                 alt="Angular"
                 class="rounded">
        </div>
        <div class="media-body">
            <div class="card-title">React Native</div>
            <p class="text-50 d-flex lh-1 mb-0 small">18 courses</p>
        </div>
    </div>

    <p class="mt-16pt text-70">Learn the fundamentals of working with React Native and how to create basic applications.</p>

    <div class="my-32pt">
        <div class="d-flex align-items-center mb-8pt justify-content-center">
            <div class="d-flex align-items-center mr-8pt">
                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                <p class="flex text-50 lh-1 mb-0"><small>50 minutes left</small></p>
            </div>
            <div class="d-flex align-items-center">
                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <a href="student-path.html"
               class="btn btn-primary mr-8pt">Resume</a>
            <a href="student-path.html"
               class="btn btn-outline-secondary ml-0">Start over</a>
        </div>
    </div>

    <div class="d-flex align-items-center">
        <small class="text-50 mr-8pt">Your rating</small>
        <div class="rating mr-8pt">
            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
            <span class="rating__item"><span class="material-icons text-primary">star_border</span></span>
        </div>
        <small class="text-50">4/5</small>
    </div>
</div>

</div>`
        }
        document.addEventListener('DOMContentLoaded', function () {
                   courses = [{ courseName: "Java", trainerName: "Ibrahim Deeb" },
            { courseName: "Web", trainerName: "Mohammad Kbaissy" },
            { courseName: "DB", trainerName: "Ibrahim Deeb" },
{ courseName: "DB", trainerName: "Ibrahim Deeb" },
{ courseName: "DB", trainerName: "Ibrahim Deeb" },
{ courseName: "DB", trainerName: "Ibrahim Deeb" }

]

            var str = '';
            courses.forEach(course => {
                str += courseCard(course)
                
            });
document.getElementById('courseCard').innerHTML = str
        })