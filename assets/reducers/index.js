import {combineReducers} from "redux";
import pages from "./pages";
import errors from "./errors";
import token from "./token";

export default combineReducers({
    pages,
    errors,
    token,
});