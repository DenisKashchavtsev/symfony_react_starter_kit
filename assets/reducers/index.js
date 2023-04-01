import {combineReducers} from "redux";
import pages from "./pages";
import errors from "./errors";

export default combineReducers({
    pages,
    errors
});