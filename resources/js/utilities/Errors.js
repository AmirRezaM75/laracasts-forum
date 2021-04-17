class Errors {
    constructor() {
        this.errors = {};
    }

    save(errors) {
        this.errors = errors;
    }

    get(field) {
        if (this.errors[field])
            return this.errors[field][0]
    }

    clear(field) {
        if (field)
            return delete this.errors[field];

        this.errors = {};
    }

    has(field) {
        return this.errors.hasOwnProperty(field)
    }

    any() {
        return Object.keys(this.errors).length > 0;
    }
}

export default Errors;
