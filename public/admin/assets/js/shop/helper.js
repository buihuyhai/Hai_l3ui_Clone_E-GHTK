function formatNumberToVND(number = 0){
    return number.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
}
