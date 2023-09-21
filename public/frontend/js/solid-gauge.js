/*
 Highcharts JS v11.1.0 (2023-06-05)

 Solid angular gauge module

 (c) 2010-2021 Torstein Honsi

 License: www.highcharts.com/license
*/
"use strict";
(function (a) {
    "object" === typeof module && module.exports
        ? ((a["default"] = a), (module.exports = a))
        : "function" === typeof define && define.amd
        ? define(
              "highcharts/modules/solid-gauge",
              ["highcharts", "highcharts/highcharts-more"],
              function (c) {
                  a(c);
                  a.Highcharts = c;
                  return a;
              }
          )
        : a("undefined" !== typeof Highcharts ? Highcharts : void 0);
})(function (a) {
    function c(a, f, c, n) {
        a.hasOwnProperty(f) ||
            ((a[f] = n.apply(null, c)),
            "function" === typeof CustomEvent &&
                window.dispatchEvent(
                    new CustomEvent("HighchartsModuleLoaded", {
                        detail: { path: f, module: a[f] },
                    })
                ));
    }
    a = a ? a._modules : {};
    c(
        a,
        "Core/Axis/SolidGaugeAxis.js",
        [a["Core/Color/Color.js"], a["Core/Utilities.js"]],
        function (a, c) {
            const { parse: f } = a,
                { extend: n, merge: u } = c;
            var v;
            (function (a) {
                const c = {
                    initDataClasses: function (a) {
                        let w = this.chart,
                            b,
                            h = 0,
                            c = this.options;
                        this.dataClasses = b = [];
                        a.dataClasses.forEach(function (e, d) {
                            e = u(e);
                            b.push(e);
                            e.color ||
                                ("category" === c.dataClassColor
                                    ? ((d = w.options.colors),
                                      (e.color = d[h++]),
                                      h === d.length && (h = 0))
                                    : (e.color = f(c.minColor).tweenTo(
                                          f(c.maxColor),
                                          d / (a.dataClasses.length - 1)
                                      )));
                        });
                    },
                    initStops: function (a) {
                        this.stops = a.stops || [
                            [0, this.options.minColor],
                            [1, this.options.maxColor],
                        ];
                        this.stops.forEach(function (a) {
                            a.color = f(a[1]);
                        });
                    },
                    toColor: function (a, c) {
                        var b = this.stops;
                        let h,
                            f,
                            e = this.dataClasses,
                            d,
                            g;
                        if (e)
                            for (g = e.length; g--; ) {
                                if (
                                    ((d = e[g]),
                                    (h = d.from),
                                    (b = d.to),
                                    ("undefined" === typeof h || a >= h) &&
                                        ("undefined" === typeof b || a <= b))
                                ) {
                                    f = d.color;
                                    c && (c.dataClass = g);
                                    break;
                                }
                            }
                        else {
                            this.logarithmic && (a = this.val2lin(a));
                            a = 1 - (this.max - a) / (this.max - this.min);
                            for (g = b.length; g-- && !(a > b[g][0]); );
                            h = b[g] || b[g + 1];
                            b = b[g + 1] || h;
                            a = 1 - (b[0] - a) / (b[0] - h[0] || 1);
                            f = h.color.tweenTo(b.color, a);
                        }
                        return f;
                    },
                };
                a.init = function (a) {
                    n(a, c);
                };
            })(v || (v = {}));
            return v;
        }
    );
    c(a, "Series/SolidGauge/SolidGaugeSeriesDefaults.js", [], function () {
        "";
        return { colorByPoint: !0, dataLabels: { y: 0 } };
    });
    c(
        a,
        "Series/SolidGauge/SolidGaugeSeries.js",
        [
            a["Extensions/BorderRadius.js"],
            a["Core/Series/SeriesRegistry.js"],
            a["Core/Axis/SolidGaugeAxis.js"],
            a["Series/SolidGauge/SolidGaugeSeriesDefaults.js"],
            a["Core/Utilities.js"],
        ],
        function (a, c, A, n, u) {
            const {
                    seriesTypes: {
                        gauge: f,
                        pie: { prototype: B },
                    },
                } = c,
                {
                    clamp: z,
                    extend: w,
                    isNumber: x,
                    merge: b,
                    pick: h,
                    pInt: y,
                } = u;
            class e extends f {
                constructor() {
                    super(...arguments);
                    this.thresholdAngleRad =
                        this.startAngleRad =
                        this.yAxis =
                        this.axis =
                        this.options =
                        this.points =
                        this.data =
                            void 0;
                }
                translate() {
                    const a = this.yAxis;
                    A.init(a);
                    !a.dataClasses &&
                        a.options.dataClasses &&
                        a.initDataClasses(a.options);
                    a.initStops(a.options);
                    f.prototype.translate.call(this);
                }
                drawPoints() {
                    const d = this.yAxis,
                        c = d.center,
                        b = this.options,
                        f = this.chart.renderer;
                    var e = b.overshoot;
                    const n = b.rounded && void 0 === b.borderRadius;
                    e = x(e) ? (e / 180) * Math.PI : 0;
                    var l;
                    x(b.threshold) &&
                        (l =
                            d.startAngleRad +
                            d.translate(
                                b.threshold,
                                void 0,
                                void 0,
                                void 0,
                                !0
                            ));
                    this.thresholdAngleRad = h(l, d.startAngleRad);
                    for (const k of this.points)
                        if (!k.isNull) {
                            var q =
                                    (y(h(k.options.radius, b.radius, 100)) *
                                        c[2]) /
                                    200,
                                r =
                                    (y(
                                        h(
                                            k.options.innerRadius,
                                            b.innerRadius,
                                            60
                                        )
                                    ) *
                                        c[2]) /
                                    200,
                                t = Math.min(d.startAngleRad, d.endAngleRad),
                                p = Math.max(d.startAngleRad, d.endAngleRad);
                            l = k.graphic;
                            var m =
                                d.startAngleRad +
                                d.translate(k.y, void 0, void 0, void 0, !0);
                            let g = d.toColor(k.y, k);
                            "none" === g &&
                                (g = k.color || this.color || "none");
                            "none" !== g && (k.color = g);
                            m = z(m, t - e, p + e);
                            !1 === b.wrap && (m = z(m, t, p));
                            p = n ? (q - r) / 2 / q : 0;
                            t = Math.min(m, this.thresholdAngleRad) - p;
                            m = Math.max(m, this.thresholdAngleRad) + p;
                            m - t > 2 * Math.PI && (m = t + 2 * Math.PI);
                            p = n ? "50%" : 0;
                            b.borderRadius &&
                                (p = a.optionsToObject(b.borderRadius).radius);
                            k.shapeArgs = r = {
                                x: c[0],
                                y: c[1],
                                r: q,
                                innerR: r,
                                start: t,
                                end: m,
                                borderRadius: p,
                            };
                            k.startR = q;
                            l
                                ? ((q = r.d),
                                  l.animate(w({ fill: g }, r)),
                                  q && (r.d = q))
                                : (k.graphic = l =
                                      f
                                          .arc(r)
                                          .attr({ fill: g, "sweep-flag": 0 })
                                          .add(this.group));
                            this.chart.styledMode ||
                                ("square" !== b.linecap &&
                                    l.attr({
                                        "stroke-linecap": "round",
                                        "stroke-linejoin": "round",
                                    }),
                                l.attr({
                                    stroke: b.borderColor || "none",
                                    "stroke-width": b.borderWidth || 0,
                                }));
                            l && l.addClass(k.getClassName(), !0);
                        }
                }
                animate(a) {
                    a ||
                        ((this.startAngleRad = this.thresholdAngleRad),
                        B.animate.call(this, a));
                }
            }
            e.defaultOptions = b(f.defaultOptions, n);
            c.registerSeriesType("solidgauge", e);
            return e;
        }
    );
    c(a, "masters/modules/solid-gauge.src.js", [], function () {});
});
//# sourceMappingURL=solid-gauge.js.map
