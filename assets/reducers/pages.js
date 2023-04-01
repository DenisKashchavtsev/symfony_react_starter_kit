import {CREATE_PAGE, DELETE_PAGE, GET_PAGE, GET_PAGES, UPDATE_PAGE,} from "../actions/types";

const initialState = [];

function pagesReducer(pages = initialState, action) {

    const {type, payload} = action;

    switch (type) {

        case GET_PAGES:
            return payload;

        case GET_PAGE:
            return payload;

        case CREATE_PAGE:
            return [...pages, payload];

        case UPDATE_PAGE:
            return pages.map((page) => {
                if (page.id === payload.id) {
                    return {
                        ...page,
                        ...payload,
                    };
                } else {
                    return page;
                }
            });

        case DELETE_PAGE:
            return pages.filter(({id}) => id !== payload.id);

        default:
            return pages;
    }
}

export default pagesReducer;