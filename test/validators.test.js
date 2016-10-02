require('amd-loader');
const assert = require('chai').assert;
const sinon = require('sinon');

const validators = require('../assets/js/validators');

describe('test', () => {
    it('should be true', () => {
        var bool = true;

        assert.isTrue(bool);

    });
});

describe('number', () => {
    it('should return true when passed a number', () => {
        var actual = validators.number(1);

        assert.isTrue(actual);
    });

    it('should return false when passed a value that is not a number', () => {
        var actual = validators.number('not a number');

        assert.isFalse(actual);
    });
});

describe('numberGroup', () => {
    it('should return array of errors', () => {
        var mockObject = {
            '#test-selector': 1,
            '#another-selector': 'not a number'
        };

        var expectedArray = [
            '#another-selector'
        ];

        var actual = validators.numberGroup(mockObject);

        assert.deepEqual(actual, expectedArray);
    });
});
