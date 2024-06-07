function showFormFields() {
    const selectedtovarf = document.getElementById('tovarf').value;
    const point_b = document.getElementById('point_b');

    switch (selectedtovarf) {
        case '8':
            point_b.outerHTML = `<select id="point_b" name="point_b">
                <option value="Баженово">Баженово</option>
                <option value="Тимашево">Тимашево</option>
                <option value="Булгаково">Булгаково</option>
                <option value="Субханкулово">Субханкулово</option>
                <option value="Знаменка">Знаменка</option>
            </select>`;
            break;
        case '13':
            point_b.outerHTML = `<select id="point_b" name="point_b">
                <option value="Москва">Москва</option>
                <option value="Санкт-Петербург">Санкт-Петербург</option>
                <option value="Сочи">Сочи</option>
                <option value="Пенза">Пенза</option>
                <option value="Самара">Самара</option>
                <option value="Казань">Казань</option>
                <option value="Рязань">Рязань</option>
                <option value="Краснодар">Краснодар</option>
                <option value="Туймазы">Туймазы</option>
                <option value="Новомичуринск">Новомичуринск</option>
            </select>`;
            break;
        case '14':
            point_b.outerHTML = `<select id="point_b" name="point_b">
            <option value="Санкт-Петербург">Санкт-Петербург</option>
            <option value="Сочи">Сочи</option>
            <option value="Пенза">Пенза</option>
            <option value="Самара">Самара</option>
            <option value="Казань">Казань</option>
            <option value="Краснодар">Краснодар</option>
        </select>`;
        break;

        default:
            point_b.outerHTML = '<input type="text" id="point_b" name="point_b">';
            break;
    }

    const extraFieldsDiv = document.getElementById('extraFields');
    extraFieldsDiv.innerHTML = '';

    if (selectedtovarf === 'Путешествие' || selectedtovarf === 'Межгород' ||  selectedtovarf === 'Экскурсионный') {
        extraFieldsDiv.style.display = 'flex';
    } else {
        extraFieldsDiv.style.display = 'none';
    }
}

function calculateTripDuration() {
    const selectedDate = new Date(document.getElementById('date').value);
    const currentDate = new Date();
    const timeDiff = Math.abs(selectedDate - currentDate);
    const days = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
    return days;
}
