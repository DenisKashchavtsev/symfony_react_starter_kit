import {
    RESET_ERRORS,
    SET_ERRORS,
} from "./types";

export const setErrors = (messages) => async (dispatch) => {
    try {
        dispatch({
            type: SET_ERRORS,
            payload: messages,
        });
    } catch (err) {
        console.log(err);
    }
};

export const resetErrors = () => async (dispatch) => {
    try {
        dispatch({
            type: RESET_ERRORS
        });
    } catch (err) {
        console.log(err);
    }
};