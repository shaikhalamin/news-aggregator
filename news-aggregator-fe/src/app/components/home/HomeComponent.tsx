"use client";

import React, { useEffect, useState } from "react";
import SingleNewsItem from "./SingleNewsItem";
import { FilterType } from "@/app/types/feedtypes";

const HomeComponent = () => {
  const [propertyList, setFeedList] = useState([]);
  const [filterClient, setFilterClient] = useState(false);
  const [active, setActive] = useState(1);
  const [loading, setLoading] = useState(false);
  const [customFilter, setCustomFilter] = useState<FilterType>({
    basic: {
      page: 1,
      perPage: 30,
    },
    filters: {},
  });

  useEffect(() => {}, []);

  return <SingleNewsItem />;
};

export default HomeComponent;
