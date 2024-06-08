import { axiosPrivate } from "../lib/axios-private";

export const getUsers = async () => {
  return axiosPrivate.get("/user-feeds", {
    headers: {
      "Content-Type": "application/json",
    },
  });
};
