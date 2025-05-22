import * as SwipeUtills from './SwipeUtills.js';
import constants from "./constants.js";

function postPrepare(post) {
    const postData = {};

    const countBox = SwipeUtills.getCountBox(post);
    const divider = SwipeUtills.getCBDivider(countBox);
    const boxNums = SwipeUtills.getBoxNums(countBox, divider);
    postData.countBox = countBox;
    postData.boxNums = boxNums;
    postData.currNum = boxNums[constants.FIRST_NUM_IND];
    postData.maxNum = boxNums[constants.SECOND_NUM_IND];
    postData.divider = divider;

    return postData;
}

export default postPrepare;