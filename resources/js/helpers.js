const wait = function(time = 1) {
    return new Promise((resolve, reject) => {
        setTimeout(() => resolve(), time);
    });
};

const formatOptionsFormDB = function(array, id = "id", text = "name") {
    return array.reduce(function(carry, item) {
        carry.push({ id: item[id], text: item[text], ...item });
        return carry;
    }, []);
};

const permutation = function(list, n = 0, result = [], current = []) {
    if (n === list.length) {
        result.push(current);
    } else {
        list[n].forEach(item =>
            permutation(list, n + 1, result, [...current, item])
        );
    }

    return result;
};

const scrollToAlert = function() {
    document.querySelector(".__alert")?.scrollIntoView({
        behavior: "smooth",
        block: "end"
    });
};

export { wait, formatOptionsFormDB, permutation, scrollToAlert };
