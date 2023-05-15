import AuthService from "../services/auth.service";
import {SET_TOKEN} from "./types";

export const login = (credentials) => async (dispatch) => {
    try {
        const res = await AuthService.login(credentials);

        console.log(res.data.token)
        dispatch({
            type: SET_TOKEN,
            payload: res.data.token,
        });
    } catch (err) {
        console.log(err);
    }
};