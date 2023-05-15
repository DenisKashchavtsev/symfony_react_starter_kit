import {RESET_TOKEN, SET_TOKEN} from "../actions/types";

const initialState = '';

function tokenReducer(token = initialState, action) {

    const {type, payload} = action;

    switch (type) {

        case SET_TOKEN:
            return payload;

        case RESET_TOKEN:
            return null;

        default:
            return null;
    }
}

export default tokenReducer;