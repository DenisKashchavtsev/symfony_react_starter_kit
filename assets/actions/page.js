import {
    GET_PAGES,
    CREATE_PAGE,
    UPDATE_PAGE,
    DELETE_PAGE, RESET_ERRORS, SET_ERRORS, GET_PAGE,
} from "./types";

import PageDataService from "../services/page.service";


export const getPages = () => async (dispatch) => {
    try {
        const res = await PageDataService.getAll();

        dispatch({
            type: GET_PAGES,
            payload: res.data.data,
        });
    } catch (err) {
        console.log(err);
    }
};

export const getPage = (id) => async (dispatch) => {
    try {
        const res = await PageDataService.get(id);

        dispatch({
            type: GET_PAGE,
            payload: res.data,
        });
    } catch (err) {
        console.log(err);
    }
};

export const createPage = (data) => async (dispatch) => {
    try {
        dispatch({type: RESET_ERRORS});

        const res = await PageDataService.create(data);

        dispatch({
            type: CREATE_PAGE,
            payload: res.data,
        });

        return Promise.resolve(res.data);
    } catch (err) {

        if (err.response.data.details.violations) {
            dispatch({
                type: SET_ERRORS,
                payload: err.response.data.details.violations
            });
        }

        return Promise.reject(err);
    }
};

export const updatePage = (id, data) => async (dispatch) => {
    try {
        const res = await PageDataService.update(id, data);

        dispatch({
            type: UPDATE_PAGE,
            payload: data,
        });

        return Promise.resolve(res.data);
    } catch (err) {
        return Promise.reject(err);
    }
};

export const deletePage = (id) => async (dispatch) => {
    try {
        await PageDataService.delete(id);

        dispatch({
            type: DELETE_PAGE,
            payload: { id },
        });
    } catch (err) {
        console.log(err);
    }
};