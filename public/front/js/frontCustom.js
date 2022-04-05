/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 4/6/2022
 */

function writeOnSearchResult(data) {
    let resultList = $('#resultList');
    resultList.empty();
    searchLoading.addClass('d-none');

    if (data.length > 0) {
        data.forEach((value, index) => {

            resultList.append(resultListFactory(value));

        });
    } else {

        let resultListValue = {
            name: 'No Product Found',
            image: window.location.origin + '/admin/images/no-image.jpg',
            slug: '#',
        };

        resultList.append(resultListFactory(resultListValue));

    }
}


function resultListFactory(value) {
    let link = window.location.origin + '/single/' + value.slug ?? '';
    let image = value.image;
    let style = 'style="margin-top: 10px;margin-bottom: 0px;"';

    if (value.slug == '#') {
        style = 'style="margin-top: 26px;margin-bottom: 0px;"';
    }

    return '<li class="list-group-item" style="z-index: 1">\n' +
        '                                                <div class="d-flex">\n' +
        '                                                    <div class="text-center col-md-4 float-left">\n' +
        '                                                        <a href="' + link + '"><img class="img-search" src="' + image + '" alt="' + value.name + '"></a>\n' +
        '                                                    </div>\n' +
        '                                                    <div class="search-Text text-center col-md-8 float-left">\n' +
        '                                                        <a class="text-dark text-decoration-none"  href="' + link + '"><p ' + style + '>' + value.name + '</p></a>\n' +
        '                                                    </div>\n' +
        '                                                </div>\n' +
        '                                            </li>';


}
